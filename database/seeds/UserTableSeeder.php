<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(\PS\Entities\User::class)->create([
            'name' => 'Ricardo',
            'email' => 'ricardomarino@live.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);
        factory(\PS\Entities\User::class, 10)->create();
    }

}
