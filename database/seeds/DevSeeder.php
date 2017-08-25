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
        $this->call(Role::class);
        $this->call(TestAccount::class);
        $this->call(EnvironmentStatus::class);
        $this->call(ProjectStatus::class);

        //Fake Data Seeders
        $this->call(FakeUser::class);
        $this->call(FakeProject::class);
        $this->call(FakeProjectComment::class);
    }
}
