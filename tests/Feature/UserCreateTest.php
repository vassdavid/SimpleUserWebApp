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
    * Deleting created users (if test passed)
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
    /**
     * Test with empty emails (negative testing)
     * @return void
     */
    public function testMissingEmails() {
      $makedUser = $this->makeUser();

      $response = $this->sendUserToJson($makedUser, array());

      $response->assertStatus(422);
    }

    public function testEmptyName() {
      //create neccesary models with factory
      $makedUser = $this->makeUser();
      $makedEmails = $this->makeEmails();

      //invalid emailformat
      $makedUser->name = null;

      $response = $this->sendUserToJson($makedUser, $makedEmails);

      $response->assertStatus(422);
    }

    public function testEmptyDateOfBirth() {
      //create neccesary models with factory
      $makedUser = $this->makeUser();
      $makedEmails = $this->makeEmails();

      //invalid emailformat
      $makedUser->date_of_birth = null;

      $response = $this->sendUserToJson($makedUser, $makedEmails);

      $response->assertStatus(422);
    }

    public function testInvaildNameFormats() {
      //create neccesary models with factory
      $makedUser = $this->makeUser();
      $makedEmails = $this->makeEmails();

      //make invalid name min
      $makedUser->name = 'gh';

      $response1 = $this->sendUserToJson($makedUser, $makedEmails);

      $response1->assertStatus(422);

      //invalid name max
      $makedUser->name = str_random(36);

      $response2 = $this->sendUserToJson($makedUser, $makedEmails);

      $response2->assertStatus(422);
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

      $response1 = $this->sendUserToJson($makedUser1, $makedEmails);

      //valid upload for user 1
      $response1->assertStatus(201);

      //invalid name max
      $response2 = $this->sendUserToJson($makedUser2, $makedEmails);

      $response2->assertStatus(422);

      //remove created item by name
      if( self::DELETING ) {
        //User model
        $userM = User::where('name', $makedUser1->name)
        ->first();
        //Email model
        $emailsM = Email::where('user_id', $userM->id)->orderBy('email');
        $emailsM->delete();
        $userM->delete();
      }
    }

    /**
     * test invaild dates:
     * - bad format
     * - tomorrow date
     * @return void
     */
    public function testInvaildDateFormats() {
      //create neccesary models with factory
      $makedUser = $this->makeUser();
      $makedEmails = $this->makeEmails();

      //invalid date format
      $makedUser->date_of_birth = "jkL45";

      //send json data
      $response1 = $this->sendUserToJson($makedUser, $makedEmails);

      $response1->assertStatus(422);

      //invalid datetime
      $datetime = new \DateTime('tomorrow');
      $makedUser->date_of_birth = $datetime->format('Y-m-d');

      $response2 = $this->sendUserToJson($makedUser, $makedEmails);

      $response2->assertStatus(422);
    }

    /**
     * test wrong email format
     * @return void
     */
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
      $user = factory(User::class)->make();
      var_dump($user->name);
      return $user;
    }

    /**
     * make email models with factory
     * @return array of \App\Email
     */
    private function makeEmails()
    {
      $number = rand(2,5);
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

    /**
     * Make
     * @param  Illuminate\Database\Eloquent\Collection $emails input emails
     * @return [type]         [description]
     */
    private function makeSimpleEmailArray($emails) {
      return $this->makeSimpleArrayByKey($emails, 'email');
    }

}
