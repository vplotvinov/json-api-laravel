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

use App\Models\Company as CompanyModel;
use App\Models\EntityModel as BonusModel;
use App\Models\UserModel as UserModel;
use App\Models\Group as GroupModel;

// $factory->define(App\BonusUsers::class, function (Faker\Generator $faker) use ($factory) {
//     return [
//         'entity_id' => $factory->create(App\Bonus::class)->id,
//         'user_id' => $factory->create(App\User::class)->id,
//     ];
// });

$factory->define(GroupModel::class, function (Faker\Generator $faker) use ($factory) {
  return [
      'title' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
      'companyId' => 1,
  ];
});

$factory->define(EntityModel::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'amount' => $faker->randomElement($array = array(5, 5, 10, 10, 15, 20, 30)),
        'author_id' => $factory->create(UserModel::class)->id,
        'text' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
    ];
});

// $factory->define(UserModel::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'company_id' => 1,
//         'role_id' => 1,
//         'points' => $faker->randomElement($array = array(100, 75, 55, 35, 10)),
//         'google_avatar' => $faker->imageUrl(100, 100, 'people'),
//     ];
// });
