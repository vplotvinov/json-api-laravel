<?php

use App\Models\AccountModel;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Seeds\Raw\RawUserFieldsTableSeeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        $faker   = Factory::create();
        $genders = ['men', 'women'];

        $accounts = AccountModel::all()->pluck('id')->toArray();

        foreach ($accounts as $account) {
            DB::table('users')->insert([
                'email'          => 'bot@website.one',
                'lastLoginAt'    => null,
                'accountId'      => $account,
                'firstName'      => $faker->firstName,
                'lastName'       => $faker->lastName,
                'userRoleId'     => 3,
                'userStatusId'   => 2,
                'outgoingPoints' => rand(0, 100),
                'budgetPoints'   => rand(0, 300),
                'avatarUrl'      => 'https://randomuser.me/api/portraits/' . $genders[rand(0, 1)] . '/' . rand(1,
                        99) . '.jpg',
            ]);
            for ($index = 1; $index < 1000; $index++) {
                if ($account === 1 && $index === 1) {
                    $email = 'vladimir@website.one';
                } else {
                    $email = $faker->unique()->email;
                }
                DB::table('users')->insert([
                    'email'          => $email,
                    'lastLoginAt'    => null,
                    'accountId'      => $account,
                    'firstName'      => $faker->firstName,
                    'lastName'       => $faker->lastName,
                    'userRoleId'     => 2,
                    'userStatusId'   => 2,
                    'outgoingPoints' => rand(0, 100),
                    'budgetPoints'   => rand(0, 300),
                    'avatarUrl'      => 'https://randomuser.me/api/portraits/' . $genders[rand(0, 1)] . '/' . rand(1,
                            99) . '.jpg',
                ]);
            }
        }
    }
}
