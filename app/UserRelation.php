<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class UserRelation extends Model
{
    //

    protected $table = 'UserRelation';

    protected $fillable = [
      'id',
      'user_id1',
      'user_id2',
      'are_friends'
    ];

    protected $dates = [
      'created_at',
    ];

}
