<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table = 'users';

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'date_of_birth'
  ];
  /**
  *  Get user email adresses
  */
  public function emails()
  {
      return $this->hasMany('App\Email');
  }
}
