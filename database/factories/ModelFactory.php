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

use FinancialSystem\Models\BankAccount;
use FinancialSystem\Models\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(User::class, 'admin', function(Faker\Generator $faker) {

    return [
        'role' => User::ROLE_ADMIN
    ];

});


$factory->define(BankAccount::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->city,
        'agency' => rand(1000, 10000),
        'account' => rand(10000, 70000) . '-' . rand(0,9)
    ];
});

$factory->define(\FinancialSystem\Models\BillPay::class, function (Faker\Generator $faker) {
    return [
        'date_due' => $faker->dateTimeThisDecade,
        'name' => $faker->word,
        'value' => $faker->randomFloat,
        'done' => $faker->boolean,
    ];
});

$factory->define(\FinancialSystem\Models\BillReceived::class, function (Faker\Generator $faker) {
    return [
        'date_due' => $faker->dateTimeThisDecade,
        'name' => $faker->word,
        'value' => $faker->randomFloat,
        'done' => $faker->boolean,
    ];
});

$factory->define(\FinancialSystem\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(\FinancialSystem\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});