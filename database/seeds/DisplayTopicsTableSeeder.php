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
        //Tiny
        DisplayTopic::create([
            'display_id' => 1,
            'topic_id' => 1,
        ]);
        DisplayTopic::create([
            'display_id' => 10,
            'topic_id' => 17,
        ]);
        DisplayTopic::create([
            'display_id' => 10,
            'topic_id' => 18,
        ]);

        //Health
        DisplayTopic::create([
            'display_id' => 2,
            'topic_id' => 2,
        ]);
        DisplayTopic::create([
            'display_id' => 3,
            'topic_id' => 3,
        ]);
        DisplayTopic::create([
            'display_id' => 4,
            'topic_id' => 4,
        ]);
        DisplayTopic::create([
            'display_id' => 5,
            'topic_id' => 5,
        ]);
        DisplayTopic::create([
            'display_id' => 6,
            'topic_id' => 6,
        ]);
    }
}
