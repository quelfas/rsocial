<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    //
    protected $table ='Contents';

    protected $fillable = [
    	'id',
    	'user_id',
    	'content_type',
    	'content_id',
    	'privacy',
    	'message',
    	'tags',
    	'active'
    ];

    protected $dates = [
      'created_at',
    ];
}
