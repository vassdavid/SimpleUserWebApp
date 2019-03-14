<?php

namespace App\Http\Controllers;

use App\User;
use App\Email;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with('emails')->orderBy('id','DESC')->paginate(24);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->validate([
        'name'  => 'required|min:3|max:35|unique:users',
        'date_of_birth' =>  'date_format:"Y-m-d"|before_or_equal:today|required',
        "emails"  =>  "required|array|min:1",
        "emails.*"  =>  "required|string|email|distinct",
      ]);

      //user model
      $user = new User([
        'name' => $data['name'],
        'date_of_birth' => $data['date_of_birth']
      ]);

      //save user
      $user->save();

      if(count($data['emails']) > 1) {
        $emails = [ ];
        foreach( $data['emails'] as $email ) {
          //get emails
          $emails[] = new Email([
            'email' => $email,
          ]);
        }
        $user->emails()->saveMany($emails);
      }
      else {
        $user->emails()->save(
          new Email([
            'email' => $data['emails'][0],
          ])
        );
      }
      //created user with emails
      return $user->load('emails');
    }

}
