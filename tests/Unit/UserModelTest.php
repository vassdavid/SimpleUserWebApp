<?php

namespace Tests\Unit;

use App\User;
use App\Email;
use Tests\TestCase;
use Tests\Traits\ArrayHelper;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use WithFaker;
    use ArrayHelper;

    //test create
    public function testCreateUser() {

      //make data
      $data = $this->makeUserData();

      //create user
      $user = $this->createUser($data);

      //check user
      $this->checkUser($user, $data);

    }

    //test read
    public function testReadUser() {
      //make data
      $data = $this->makeUserData();

      //create user
      $user = $this->createUser($data);

      //find user
      $found = User::find($user->id);

      //check user
      $this->checkUser($found->load('emails'), $data);
    }

    private function checkUser( $user, $data ) {

      $this->assertInstanceOf(User::class, $user);
      $this->assertEquals($data['name'], $user->name);
      $this->assertEquals($data['date_of_birth'], $user->date_of_birth);

      //make array
      $emails = $this->makeSimpleArrayByKey($user->emails, 'email');

      //check two array has same items
      $this->assertTrue(
        $this->arraysHasSameItems($emails, $data['emails'])
      );
    }

    private function createUser( $data ) {

      //user model
      $user = new User([
        'name' => $data['name'],
        'date_of_birth' => $data['date_of_birth']
      ]);

      //save user
      $user->save();

      //save emails
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
      return $user;
    }

    private function makeUserData() {
      $data = [
          'name' => $this->faker->unique()->name,
          'date_of_birth' => $this->faker->date( 'Y-m-d', now() ),
          'emails' => []
      ];
      $number = rand(1,5);
      for( $i=0; $i<$number; $i++ )
        $data['emails'][] = $this->faker->unique()->safeEmail;

      return $data;
    }

}
