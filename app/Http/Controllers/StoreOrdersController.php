<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Order;
use App\OrderActivity;
use App\OrderStatus;
use Auth;
use App\City;
use App\State;
use App\Country;
use App\Cart;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;
use Response;
use App\User;
use App\Address;

use SmsaSDK\Smsa;


class StoreOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 25;
        $user_id = Auth::id();
        $storeorders = Order::where('user_id', $user_id)->latest()->paginate($perPage);
        // dd($storeorders);
        $orderstatus = OrderStatus::pluck('order_status', 'id');
        return view('store-orders.index', compact('storeorders', 'orderstatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $storeorder = Order::where('id', $id)->first();
        $orderstatus = OrderStatus::pluck('order_status', 'id');
        return view('store-orders.show', compact('storeorder', 'orderstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect('store-order')->with('success', 'Store Orders deleted!');
    }

    public function storeOrderStatusChange(Request $request)
    {
        $id = $request->order_id;
        $order = Order::where('id',$id)->first();
        $order->order_status_id = $request->order_status_id;
        $order->save();
        return redirect('store-order')->with('success', 'Order Status updated!');
    }

    public function addShipmentToSmsa($order_id, $user_id, $address_id)
    {


        $user_data          = User::where('id', $user_id)->first();
        $order_data         = Order::where('id', $order_id)->first();
        $address_data       = Address::where('id', $address_id)->first();
        $state_data         = State::where('id', $address_data->state_id)->first();
        $city_data          = City::where('id', $address_data->city_id)->first();
        $country_data       = Country::where('id',$address_data->country_id)->first();

        if (($order_data->payment_method == "Paytab") && ($order_data->paytab_transation_id != null)) {
            $cod_amount = 0;
        }else{
            $cod_amount = $order_data->final_price;
        }

        $refNo              = $order_data->id;
        $name               = $user_data->name;
        $email              = $user_data->email;
        $country            = $country_data->code;
        $city               = $state_data->name;
        $mobile             = $address_data->phone_no;
        $address1           = "Neighbor ".$city_data->name.", ";
        $address2           = "Location: ".$address_data->location.", ".$address_data->pin_code;
        $ship_type          = "DLV";
        $pcs                = 1;
        $weight             = '0.5';
        $item_description   = 'Mobile case';
        // dd($address1);

        Smsa::nullValues('');
        $shipmentData = [
                'refNo' => $refNo, // shipment reference in your application
                'cName' => $name, // customer name
                'Cntry' => $country, // shipment country
                'cCity' => $city, // shipment city, try: Smsa::getRTLCities() to get the supported cities
                'cMobile' => $mobile, // customer mobile
                'cAddr1' => $address1, // customer address
                'cAddr2' => $address2, // customer address 2
                'shipType' => $ship_type, // shipment type
                'PCs' => $pcs, // quantity of the shipped pieces
                'cEmail' => $email, // customer email
                'codAmt' => $cod_amount, // payment amount if it's cash on delivery, 0 if not cash on delivery
                'weight' => $weight, // pieces weight
                'itemDesc' => $item_description, // extra description will be printed
            ];
        $shipment = Smsa::addShipment($shipmentData);
        $awbNumber = $shipment->getAddShipmentResult();
        // dd($awbNumber);

        if (is_numeric($awbNumber)) {

            $order                  = Order::where('id', $order_id)->first();
            $order->smsa_awab_number = $awbNumber;
            $order->order_status_id    = 5;
            $order->save();

        }else{

            if (strpos($awbNumber, '#') !== false) {
                $oldawbNumber =  explode('# ', $awbNumber);

                $order                  = Order::where('id', $order_id)->first();
                $order->smsa_awab_number = $oldawbNumber[1];
                $order->order_status_id    = 5;
                $order->save();
            }else{
                dd($awbNumber);
            }

        }

        return back();
    }
}
