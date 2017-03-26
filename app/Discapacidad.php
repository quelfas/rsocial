<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    //
    protected $table = 'Discapacidad';

    protected $fillable = [
    	'id',
    	'user_id',
    	'discapacidad',
    	'resena',
    ];

    protected $dates = [
      'created_at',
    ];
}
