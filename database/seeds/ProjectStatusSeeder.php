<?php

use Illuminate\Database\Seeder;

class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'On-Track', 'description' => 'Current project is on-track.'],
            ['name' => 'Caution', 'description' => 'Project could possibly have a hold up.'],
            ['name' => 'At-Risk', 'description' => 'Project possibly at risk for stall.'],
        ];

        DB::table('project_status')->insert($data);
//        \App\ProjectStatus::insert($data);
    }
}
