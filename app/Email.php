<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
  protected $table = 'emails';
  protected $visible = [ 'email' ];

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'email', 'user_id'
  ];
}
