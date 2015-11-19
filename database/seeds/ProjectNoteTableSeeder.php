<?php

use Illuminate\Database\Seeder;

class ProjectNoteTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(\PS\Entities\ProjectNote::class, 500)->create();
    }

}
