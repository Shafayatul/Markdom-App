<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'carts';

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
    protected $fillable = ['user_id', 'product_id', 'quantity', 'unit_price', 'is_cart'];
}
