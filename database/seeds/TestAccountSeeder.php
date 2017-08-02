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

        //Development Manager
        DB::table('users')->insert([
            'first_name' => 'Development',
            'last_name' => 'Manager',
            'email' => 'development-manager@scientificgames.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '3',
            'role_id' => '3',
        ]);

        //Project Manager
        DB::table('users')->insert([
            'first_name' => 'Project',
            'last_name' => 'Manager',
            'email' => 'project-manager@scientificgames.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '4',
            'role_id' => '3',
        ]);

        //Admin Account
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Account',
            'email' => 'admin@scientificgames.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '5',
            'role_id' => '1',
        ]);

        //Dev Account
        DB::table('users')->insert([
            'first_name' => 'Developer',
            'last_name' => 'Account',
            'email' => 'developer@scientificgames.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '6',
            'role_id' => '4',
        ]);

        //Vendor Account
        DB::table('users')->insert([
            'first_name' => 'Vendor',
            'last_name' => 'Account',
            'email' => 'vendor@scientificgames.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '7',
            'role_id' => '8',
        ]);

        //Customer Account
        DB::table('users')->insert([
            'first_name' => 'Customer',
            'last_name' => 'Account',
            'email' => 'customer@scientificgames.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '8',
            'role_id' => '5',
        ]);

        //Account Manager
        DB::table('users')->insert([
            'first_name' => 'Account',
            'last_name' => 'Manager',
            'email' => 'account-manager@scientificgames.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '9',
            'role_id' => '7',
        ]);

        //Executive Account
        DB::table('users')->insert([
            'first_name' => 'Executive',
            'last_name' => 'Account',
            'email' => 'executive@scientificgames.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users_roles')->insert([
            'user_id' => '10',
            'role_id' => '6',
        ]);
    }
}
