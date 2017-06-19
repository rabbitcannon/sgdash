<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Super Administrator', 'description' => 'Full-Access to application.'],
            ['name' => 'Vendor', 'description' => 'Vendor level access.'],
        ];

        \App\Roles::insert($data);
    }
}
