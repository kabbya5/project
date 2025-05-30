<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TimeLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()->count(40)->create()->each(function($project){
            TimeLog::factory()->count(rand(0,10))->create([
                'project_id' => $project->id,
                'user_id' => $project->user_id,
            ]);
        });
    }
}
