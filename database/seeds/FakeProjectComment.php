<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Project;
use App\User;

class FakeProjectComment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $user = User::all()->pluck('id');
        $project = Project::all()->pluck('id');

        $this->command->getOutput()->progressStart(300);

        foreach(range(1,300) as $index) {
            App\Comment::insert([
                'user_id'       => $faker->randomElement($user->toArray()),
                'project_id'    => $faker->randomElement($project->toArray()),
                'comment'       => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'created_at'    => $faker->dateTime($max = 'now')
            ]);

            $this->command->getOutput()->progressAdvance(1);
        }

        $this->command->getOutput()->progressFinish();
    }
}
