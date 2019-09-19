<?php

use App\Models\AccountModel;
use App\Models\UserModel;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EntitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('entities')->delete();

        $faker    = Factory::create();
        $accounts = AccountModel::all()->pluck('id')->toArray();

        foreach ($accounts as $account) {
            $users = UserModel::all()->where('accountId', $account)->pluck('id')->toArray();

            for ($i = 1; $i < 100; $i++) {
                DB::table('entities')
                  ->insert([
                      'authorId' => $users[array_rand($users)],
                      'text'     => $faker->realText($maxNbChars = 200, $indexSize = 2),
                      'accountId' => $account,
                  ]);
            }
        }

    }
}
