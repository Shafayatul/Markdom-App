<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

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
    protected $fillable = ['title', 'title_arabic', 'type', 'amount', 'percentage', 'image', 'module_id'];

    
}
