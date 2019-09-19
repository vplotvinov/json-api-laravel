<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userRoles')->delete();

        DB::table('userRoles')->insert([
            'title' => 'User',
            'enum' => 'user',
            'description' => 'Authorized user can manage only personal data.',
        ]);

        DB::table('userRoles')->insert([
            'title' => 'Admin',
            'enum' => 'admin',
            'description' => 'Admin can manage account, all users, etc.',
        ]);
    }
}
