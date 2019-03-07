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
        return User::with('emails')->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'date_of_birth' =>  'date_format:"Y-m-d"|required',
        "email"  =>  "required|array|min:1",
        "email.*"  =>  "required|string|email|distinct",
      ]);
      //user model
      $user = new User([
        'name' => $data['name'],
        'date_of_birth' => $data['date_of_birth']
      ]);

      if( $user->save() )
        foreach( $data['email'] as $email ) {
          //email model
          $emailEntity = new Email([
            'user_id' => $user->id,
            'email' => $email,
          ]);
          $emailEntity->save();
        }
      //created user with emails
      $user->emails;
      return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
