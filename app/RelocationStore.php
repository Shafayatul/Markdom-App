<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelocationStore extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'relocation_stores';

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
    protected $fillable = ['name', 'name_arabic', 'description', 'arabic_description', 'preview_image', 'multiple_images', 'lat', 'lng', 'status', 'store_owner_id', 'location', 'arabic_location', 'module_id'];

    
}
