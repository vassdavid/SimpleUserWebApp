<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    //settings:
    /*
    * Deleting created users
    */
    const DELETING = true;

    /**
     * valid upload test for user
     *
     * @return void
     */
    public function testSuccessUserCreating()
    {
        //create neccesary models with factory
        $makedUser = $this->makeUser();
        $makedEmails = $this->makeEmails();

        $response = $this->json(
          'POST',
          '/api/user',
          $this->createFormData( $makedUser, $makedEmails )
        );

        $response
        ->assertStatus(201)
        //give a created user
        ->assertJson(
          $makedUser->toArray()
        )
        ;

        //User model
        $userM = \App\User::where('name', $makedUser->name)
        ->first();
        
        //Email model
        $emailsM = \App\Email::where('user_id', $userM->id)->orderBy('email');

        //check user is created
        $this->assertEquals($userM->toArray(), $makedUser->toArray());

        //check email(s) is created
        $this->assertEquals(
          $userM->emails->sortBy('email')->toArray(),
          $emailsM->get()->toArray()
        );

        //remove created item by name
        if( self::DELETING ) {
          $emailsM->delete();
          $userM->delete();
        }

    }

    public function testGetUserAPI()
    {
      $response = $this->get('/api/user');
      $response->assertStatus(200);
    }

    /**
    * Make User with factory
    * @return User
    */
    private function makeUser()
    {
      return factory(\App\User::class)->make();
    }

    /**
     * make email models with factory
     * @return array of \App\Email
     */
    private function makeEmails()
    {
      $number = rand(1,5);
      $emails = [];

      if($number == 1)
      {
        $emails = [factory(\App\Email::class)->make()];
      }
      else
      {
        $emails = factory(\App\Email::class,$number)->make();
      }
      return $emails;
    }

    /**
    * Create form data
    * @param \App\User $user
    * @param array of \App\Email $emails
    * @return array
    *
    */
    private function createFormData(\App\User $user, $emails) {
      $formEmails = [];
      foreach ($emails as $email) {
        $formEmails[] = "{$email['email']}";
      }
      return [
        'name' => "{$user->name}",
        'date_of_birth' => "{$user->date_of_birth}",
        'emails' =>  $formEmails
      ];
    }

}
