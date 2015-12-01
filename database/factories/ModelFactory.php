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

$factory->define(PS\Entities\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(PS\Entities\Client::class, function ($faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence,
    ];
});
$factory->define(PS\Entities\Project::class, function ($faker) {
    return [
        'owner_id' => rand(1, 10),
        'client_id' => rand(1, 10),
        'name' => $faker->word,
        'description' => $faker->sentence,
        'progress' => rand(1, 100),
        'status' => rand(1, 3),
        'due_date' => $faker->dateTime('now')
    ];
});
$factory->define(PS\Entities\ProjectNote::class, function ($faker) {
    return [
        'project_id' => rand(1, 10),
        'title' => $faker->word,
        'note' => $faker->paragraph,
    ];
});
$factory->define(PS\Entities\ProjectTask::class, function ($faker) {
    return [
        'project_id' => rand(1, 10),
        'name' => $faker->word,
        'status' => rand(1, 3),
        'due_date' => $faker->dateTime('now'),
    ];
});
$factory->define(PS\Entities\ProjectMember::class, function ($faker) {
    return [
        'project_id' => rand(1, 10),
        'member_id' =>rand(1, 10),
    ];
});
$factory->define(PS\Entities\OAuthClient::class, function ($faker) {
    return [
        'id' => rand(1, 1000),
        'secret' => $faker->word,
        'name' => $faker->word,
    ];
});