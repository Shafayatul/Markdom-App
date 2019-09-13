<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSubCategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_sub_categories';

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
    protected $fillable = ['user_id', 'service_category_id', 'name', 'name_arabic'];

    
}
