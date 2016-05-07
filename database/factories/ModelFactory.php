<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Rebuy\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'tel'            => $faker->phoneNumber,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Rebuy\Post::class, function (Faker\Generator $faker) {
    return [
        'type'    => 0,
        'title'   => $faker->sentence,
        'body'    => $faker->realText(),
        'user_id' => $faker->randomElement(\Rebuy\User::lists('id')->toArray())
    ];
});

$factory->define(Rebuy\Comment::class, function (Faker\Generator $faker) {
    return [
        'body'    => $faker->sentence,
        'user_id' => $faker->randomElement(\Rebuy\User::lists('id')->toArray()),
        'post_id' => $faker->randomElement(\Rebuy\Post::lists('id')->toArray())
    ];
});

$factory->define(Rebuy\Product::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->sentence,
        'user_id'     => $faker->randomElement(\Rebuy\User::lists('id')->toArray()),
        'price'       => $faker->randomFloat(),
        'inventory'   => $faker->randomDigit,
        'metas'        => "{}",
        'description' => ''
    ];
});