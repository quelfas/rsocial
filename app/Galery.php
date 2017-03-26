<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    //
    protected $table ='Galery';

    protected $fillable = [
    	'id',
    	'user_id',
    	'galery_name',
    	'image_name',
    	'image_real',
    	'size',
    	'type',
    	'privacy',
    	'tags',
    	'active'
    ];

    protected $dates = [
      'created_at',
    ];
}
