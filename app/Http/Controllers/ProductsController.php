<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Store;
use App\SubSubCategory;
use App\ServiceCategory;
use App\ServiceSubCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $products = Product::where('store_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('preview_image', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $products = Product::latest()->paginate($perPage);
        }
        $stores = Store::pluck('name', 'id');
        $subsubcategories = SubSubCategory::pluck('name', 'id');
        $service_categories = ServiceCategory::pluck('name', 'id');
        $service_sub_categories = ServiceSubCategory::pluck('name', 'id');
        return view('products.index', compact('products', 'stores', 'subsubcategories', 'service_categories', 'service_sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $stores = Store::pluck('name', 'id');
        $subsubcategories = SubSubCategory::pluck('name', 'id');
        $service_categories = ServiceCategory::pluck('name', 'id');
        $service_sub_categories = ServiceSubCategory::pluck('name', 'id');
        return view('products.create', compact('stores', 'subsubcategories', 'service_categories', 'service_sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       if($request->hasFile('preview_image')){
            $image      = $request->file('preview_image');
            $image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path       = 'product-image/';
            $image_url  = $path.$image_name;
            $image->move($path,$image_name);
        }else{
            $image_url  = null;
        }

        if($request->hasFile('multiple_images')){
            $multi_images      = $request->file('multiple_images');

            foreach($multi_images as $image)
            {
                $multi_image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
                $multi_image_path = 'product-images/';
                $multi_image_url  = $multi_image_path.$multi_image_name;
                $image->move($multi_image_path, $multi_image_name);
                $data[] = $multi_image_url;  
            }
        }else{
            $data[]  = null;
        }

        $product                            = new Product();
        $product->store_id                  = $request->store_id;
        $product->sub_sub_category_id       = $request->sub_sub_category_id;
        $product->service_category_id       = $request->service_category_id;
        $product->service_sub_category_id   = $request->service_sub_category_id;
        $product->name                      = $request->name;
        $product->name_arabic               = $request->name_arabic;
        $product->description               = $request->description;
        $product->description_arabic        = $request->description_arabic;
        $product->preview_image             = $image_url;
        if($data[0] == null){
            $data_img = null;
        }else{
            $data_img = implode(',', $data);
        }
        $product->multiple_images           = $data_img;
        $product->price                     = $request->price;
        $product->save();

        return redirect('products/create')->with('success', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $stores = Store::pluck('name', 'id');
        $subsubcategories = SubSubCategory::pluck('name', 'id');
        $service_categories = ServiceCategory::pluck('name', 'id');
        $service_sub_categories = ServiceSubCategory::pluck('name', 'id');
        return view('products.show', compact('product', 'stores', 'subsubcategories', 'service_categories', 'service_sub_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $stores = Store::pluck('name', 'id');
        $subsubcategories = SubSubCategory::pluck('name', 'id');
        $service_categories = ServiceCategory::pluck('name', 'id');
        $service_sub_categories = ServiceSubCategory::pluck('name', 'id');
        return view('products.edit', compact('product', 'stores', 'subsubcategories', 'service_categories', 'service_sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($request->hasFile('preview_image')){
            $image      = $request->file('preview_image');
            $image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path       = 'product-image/';
            $image_url  = $path.$image_name;
            $image->move($path,$image_name);
            if($product->preview_image != null){
                unlink($product->preview_image);
            }
        }else{
            $image_url  = $product->preview_image;
        }


        if($request->hasFile('multiple_images')){
            $multi_images      = $request->file('multiple_images');

            foreach($multi_images as $image)
            {
                $multi_image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
                $multi_image_path = 'product-image/';
                $multi_image_url  = $multi_image_path.$multi_image_name;
                $image->move($multi_image_path, $multi_image_name);
                $data[] = $multi_image_url;  
            }
            if($store->multiple_images != null){
                $multiple_img = explode(',', $store->multiple_images);
                foreach($multiple_img as $img)
                {
                    unlink($img);
                }
            }
        }else{
            $data[]  = $store->multiple_images;
        }

        $product->store_id                  = $request->store_id;
        $product->sub_sub_category_id       = $request->sub_sub_category_id;
        $product->service_category_id       = $request->service_category_id;
        $product->service_sub_category_id   = $request->service_sub_category_id;
        $product->name                      = $request->name;
        $product->name_arabic               = $request->name_arabic;
        $product->description               = $request->description;
        $product->description_arabic        = $request->description_arabic;
        $product->preview_image             = $image_url;
        if($data[0] == null){
            $data_img = null;
        }else{
            $data_img = implode(',', $data);
        }
        $product->multiple_images           = $data_img;
        $product->price                     = $request->price;
        $product->save();

        return redirect('products')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->preview_image != null){
            unlink($product->preview_image);
        }
        if($product->multiple_images != null){
            $multiple_img = explode(',', $product->multiple_images);
            foreach($multiple_img as $img)
            {
                unlink($img);
            }
        }
        Product::destroy($id);

        return redirect('products')->with('success', 'Product deleted!');
    }
}
