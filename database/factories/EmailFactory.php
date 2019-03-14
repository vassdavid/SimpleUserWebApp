<?php
use App\Email;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Email::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
