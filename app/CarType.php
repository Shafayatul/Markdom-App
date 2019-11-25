<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'car_types';

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
    protected $fillable = ['store_id', 'name', 'name_arabic', 'per_mile_price'];

    
}
