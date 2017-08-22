<?php

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(TestAccountSeeder::class);
        $this->call(EnvironmentStatusSeeder::class);
        $this->call(ProjectStatusSeeder::class);

        //Fake Data Seeders
        $this->call(FakeUserSeeder::class);
        $this->call(FakeProjectSeeder::class);
    }
}
