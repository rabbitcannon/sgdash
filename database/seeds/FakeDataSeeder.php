<?php

use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FakeUserSeeder::class);
        $this->call(FakeProjectSeeder::class);
    }
}
