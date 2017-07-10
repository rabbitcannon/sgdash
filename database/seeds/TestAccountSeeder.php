<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon as Carbon;

class TestAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Robert',
            'last_name' => 'Blahut',
            'email' => 'anesthetikal@gmail.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '1',
            'role_id' => '1',
        ]);

        DB::table('users')->insert([
            'first_name' => 'Michael',
            'last_name' => 'Kramer',
            'email' => 'michael.kramer@scientificgames.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '2',
            'role_id' => '2',
        ]);
    }
}
