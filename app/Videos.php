<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    //
    protected $table ='Videos';

    protected $fillable = [
    	'id',
    	'user_id',
    	'url_frame',
    	'url_link',
    	'privacy',
    	'parental',
    	'tags',
    	'active'
    ];

    protected $dates = [
      'created_at',
    ];
}
