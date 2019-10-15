<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestuarentCustomerOrder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'restuarent_customer_orders';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'store_id', 'order_details', 'driver_id', 'offer_price', 'image', 'is_accepted'];

    
}
