<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class FakeProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $status = \App\ProjectStatus::all()->pluck('id');
        $user = User::all()->pluck('id');
        $acct_manager = User::whereHas('role', function ($query) { $query->where('role_id', '=', 7); })->pluck('id');

        foreach(range(1,30) as $index) {
            App\Projects::create([
                'created_by' => $faker->randomElement($user->toArray()),
                'code' => $faker->numberBetween($min = 100, $max = 99999),
                'name' => $faker->words($nb = 3, $asText = true),
                'acct_manager' => $faker->randomElement($acct_manager->toArray()),
                'req_eta' => $faker->randomElement($status->toArray()),
                'req_status' => $faker->randomElement($status->toArray()),
                'dev_eta' => $faker->dateTime($max = 'now'),
                'dev_status' => $faker->randomElement($status->toArray()),
                'qa_eta' => $faker->dateTime($max = 'now'),
                'qa_status' => $faker->randomElement($status->toArray()),
                'uat_eta' => $faker->dateTime($max = 'now'),
                'uat_status' => $faker->randomElement($status->toArray()),
                'prod_eta' => $faker->dateTime($max = 'now'),
                'prod_status' => $faker->randomElement($status->toArray()),
                'created_at' => $faker->dateTime($max = 'now')
            ]);
        }
    }
}
