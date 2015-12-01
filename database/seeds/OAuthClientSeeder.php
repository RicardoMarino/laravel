<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\PS\Entities\OAuthClient::class)->create([
            'id' => 1,
            'secret' => 'secret',
            'name' => 'app'
        ]);
    }
}
