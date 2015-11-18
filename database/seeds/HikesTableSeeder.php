<?php

use Illuminate\Database\Seeder;

class HikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Hike::class, 10)->create();
    }
}
