<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
    protected $fillable = ['order_details', 'user_id', 'cart_ids', 'total_price', 'address_id', 'final_price', 'order_status_id', 'image', 'payment_method', 'estimated_time', 'paytab_transation_id', 'smsa_awab_number'];

    
}
