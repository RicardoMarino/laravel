<?php

use Illuminate\Database\Seeder;

class ProjectTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\PS\Entities\ProjectTask::class, 1000)->create();
    }
}
