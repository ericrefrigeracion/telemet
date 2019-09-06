<?php

use App\Pay;
use App\User;
use App\Alert;
use App\Device;
use App\Reception;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PricesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserPermissionsTableSeeder::class);

        //factory(User::class, 25)->create();
        //factory(Device::class, 150)->create();
        //factory(Alert::class, 250)->create();
        //factory(Reception::class, 15000)->create();
    }
}
