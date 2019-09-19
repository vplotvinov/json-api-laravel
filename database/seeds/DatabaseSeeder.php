<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::Environment() === 'local') {
            $this->call('AccountsTableSeeder');
            $this->call('UsersTableSeeder');
            $this->call('EntitiesTableSeeder');
        }
    }
}
