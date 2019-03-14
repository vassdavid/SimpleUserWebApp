<?php


use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\User::class, 50)->create()->each(function ($user) {
          $number = rand(1,5);
          if($number == 1)
            $user->emails()->save(factory(App\Email::class)->make(['user_id'=> $user->id]));
          else
            $user->emails()->saveMany(factory(App\Email::class,$number)->make(['user_id'=> $user->id]));
      });
    }
}
