<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\ProjectStatus;
use App\EnvironmentStatus;
use App\Role;
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
        $status = ProjectStatus::all()->pluck('id');
        $env_status = EnvironmentStatus::all()->pluck('id');
        $user = User::all()->pluck('id');
        $roles = Role::all();
        $trends = Config::get('projects.trend');

        foreach($roles as $role) {
            if($role->name === "Development Manager")
                $dev_id = $role->id;
            if($role->name === "Account Manager")
                $acct_id = $role->id;
            if($role->name === "Project Manager")
                $proj_id = $role->id;
        }

        $acct_manager = User::whereHas('role', function ($query) use ($acct_id) { $query->where('role_id', '=', $acct_id); })->pluck('id');
        $dev_manager = User::whereHas('role', function ($query) use ($dev_id) { $query->where('role_id', '=', $dev_id); })->pluck('id');
        $project_manager = User::whereHas('role', function ($query) use ($proj_id) { $query->where('role_id', '=', $proj_id); })->pluck('id');

        foreach(range(1,30) as $index) {
            App\Project::create([
                'created_by' => $faker->randomElement($user->toArray()),
                'code' => $faker->numberBetween($min = 100, $max = 99999),
                'name' => $faker->words($nb = 3, $asText = true),
                'status' => $faker->randomElement($status->toArray()),
                'acct_manager' => $faker->randomElement($acct_manager->toArray()),
                'dev_manager' => $faker->randomElement($dev_manager->toArray()),
                'project_manager' => $faker->randomElement($project_manager->toArray()),
                'trend' => array_rand($trends),
                'req_eta' => $faker->randomElement($env_status->toArray()),
                'req_status' => $faker->randomElement($env_status->toArray()),
                'dev_eta' => $faker->dateTime($max = 'now'),
                'dev_status' => $faker->randomElement($env_status->toArray()),
                'qa_eta' => $faker->dateTime($max = 'now'),
                'qa_status' => $faker->randomElement($env_status->toArray()),
                'uat_eta' => $faker->dateTime($max = 'now'),
                'uat_status' => $faker->randomElement($env_status->toArray()),
                'prod_eta' => $faker->dateTime($max = 'now'),
                'prod_status' => $faker->randomElement($env_status->toArray()),
                'created_at' => $faker->dateTime($max = 'now')
            ]);
        }
    }
}
