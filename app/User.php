<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table = 'users';
  protected $visible = ['name', 'date_of_birth', 'emails'];

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'date_of_birth', 'id'
  ];
  /**
  *  Get user email adresses
  */
  public function emails()
  {
      return $this->hasMany('App\Email')->orderBy('email');
  }
}
