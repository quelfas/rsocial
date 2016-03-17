<?php

namespace App;
use Carbon;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'name',
        'last_name',
        'birthdate',
        'gender',
        'country',
        'locale',
        'phone',
        'privacy',
        'connections',
        'bio'
      ];

      protected $dates = [
        'birthdate',
      ];
}
