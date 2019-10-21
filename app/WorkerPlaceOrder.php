<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerPlaceOrder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'worker_place_orders';

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
    protected $fillable = ['user_id', 'cart_ids', 'total_price', 'address_id', 'final_price', 'order_status_id','estimated_time', 'schedule_time_id', 'service_type_id', 'promo_code', 'discount_percent', 'discount_amount'];

}
