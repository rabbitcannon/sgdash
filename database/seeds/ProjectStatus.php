<?php

use Illuminate\Database\Seeder;

class ProjectStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'New', 'description' => 'New project.'],
            ['name' => 'Active', 'description' => 'Project is currently active.'],
            ['name' => 'Complete', 'description' => 'Project has been completed.'],
            ['name' => 'Deferred', 'description' => 'Project deferred.'],
            ['name' => 'Suspended', 'description' => 'Project that has been suspended.'],
        ];

        DB::table('project_status')->insert($data);
    }
}
