<?php

use App\DisplayTopic;
use Illuminate\Database\Seeder;

class DisplayTopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DisplayTopic::create([
            'display_id' => 1,
            'topic_id' => 1,
        ]);
    }
}
