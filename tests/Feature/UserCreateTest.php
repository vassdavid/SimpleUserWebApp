<?php

namespace Tests\Feature;

use App\User;
use App\Email;
use Tests\TestCase;
use Tests\Traits\ArrayHelper;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    use ArrayHelper;
    //settings:
    /*
    * Deleting created users
    */
    const DELETING = false;

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

        $response = $this->sendUserToJson($makedUser, $makedEmails);

        $response
        ->assertStatus(201)
        //give a created user
        ->assertJson(
          $makedUser->toArray()
        );

        //User model
        $userM = User::where('name', $makedUser->name)
        ->first();

        //Email model
        $emailsM = Email::where('user_id', $userM->id)->orderBy('email');

        //check user is created
        $this->assertEquals($userM->toArray(), $makedUser->toArray());

        //get array format
        $emailsBeforeSend = $this->makeSimpleEmailArray($makedEmails);
        $emailsAfterSend = $this->makeSimpleEmailArray($emailsM->get());

        $this->assertTrue(
          $this->arraysHasSameItems($emailsBeforeSend, $emailsAfterSend)
        );

        //remove created item by name
        if( self::DELETING ) {
          $emailsM->delete();
          $userM->delete();
        }

    }
    /**
     * Send user to store
     * @param  \App\User $user
     * @param  Illuminate\Database\Eloquent\Collection $emails
     * @return void
     */
    private function sendUserToJson(\App\User $user, $emails) {
      return $this->json(
        'POST',
        '/api/user',
        $this->createFormData( $user, $emails )
      );
    }

    /**
     * test dupicated email
     * @return void
     */
    public function testDupicatedEmail() {
      //create neccesary models with factory
      $makedUser = $this->makeUser();
      $makedEmails = $this->makeEmails();

      //copy add first email one more time
      $makedEmails->push($makedEmails[0]);

      $response = $this->sendUserToJson($makedUser, $makedEmails);

      $response->assertStatus(422);

    }

    public function testInvaildNameFormats() {
      //create neccesary models with factory
      $makedUser = $this->makeUser();
      $makedEmails = $this->makeEmails();

      //make invalid name min
      $makedUser->name = 'gh';

      $response = $this->sendUserToJson($makedUser, $makedEmails);

      $response->assertStatus(422);

      //invalid name max
      $makedUser->name = str_random(36);

      $response = $this->sendUserToJson($makedUser, $makedEmails);

      $response->assertStatus(422);
    }
    /**
     * test duplicated name
     * @return void
     */
    public function testInvaildNameIsExist() {
      //create neccesary models with factory
      //If db is empty!! double creating name
      $makedUser1 = $this->makeUser();
      $makedEmails = $this->makeEmails();
      //user2
      $makedUser2 = $this->makeUser();

      //set user 1 name to user2
      $makedUser2->name = $makedUser1->name;

      $response = $this->sendUserToJson($makedUser1, $makedEmails);

      //valid upload for user 1
      $response->assertStatus(201);

      //invalid name max
      $response = $this->sendUserToJson($makedUser2, $makedEmails);

      $response->assertStatus(422);
    }


    public function testInvaildDateFormats() {
      //create neccesary models with factory
      $makedUser = $this->makeUser();
      $makedEmails = $this->makeEmails();

      //invalid date format
      $makedUser->date_of_birth = "jkL45";

      //send json data
      $response = $this->sendUserToJson($makedUser, $makedEmails);

      $response->assertStatus(422);

      //invalid datetime
      $datetime = new \DateTime('tomorrow');
      $makedUser->date_of_birth = $datetime->format('Y-m-d');

      $response = $this->sendUserToJson($makedUser, $makedEmails);

      $response->assertStatus(422);
    }


    public function testInvaildEmailFormats() {
      //create neccesary models with factory
      $makedUser = $this->makeUser();
      $makedEmails = $this->makeEmails();

      //invalid emailformat
      $makedEmails[0]->email = "jhdjk";

      $response = $this->sendUserToJson($makedUser, $makedEmails);

      $response->assertStatus(422);
    }


    /**
    * Make User with factory
    * @return User
    */
    private function makeUser()
    {
      return factory(User::class)->make();
    }

    /**
     * make email models with factory
     * @return array of \App\Email
     */
    private function makeEmails()
    {
      $number = rand(1,5);
      $emails = factory(Email::class,$number)->make();

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
      $formEmails = $this->makeSimpleEmailArray($emails);
      return [
        'name' => "{$user->name}",
        'date_of_birth' => "{$user->date_of_birth}",
        'emails' =>  $formEmails
      ];
    }

    private function makeSimpleEmailArray($emails) {
      return $this->makeSimpleArrayByKey($emails, 'email');
    }

}
