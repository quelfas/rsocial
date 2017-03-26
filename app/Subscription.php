<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //

    protected $table = 'Subscription';

    protected $fillable = [
      'id',
      'user_id',
      'subscribe_id',
      'active',
    ];

    protected $dates = [
      'created_at',
      'updated_at',
    ];
}
