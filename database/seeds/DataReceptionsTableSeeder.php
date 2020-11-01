<?php

use App\DataReception;
use Illuminate\Database\Seeder;

class DataReceptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DataReception::class, 1500)->create();
    }
}
