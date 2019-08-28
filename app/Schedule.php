<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schedules';

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
    protected $fillable = ['schedule_type_id', 'store_id', 'day_id', 'timespan'];

    
}
