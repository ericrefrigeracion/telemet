<?php

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
        $this->call(IconsTableSeeder::class);
        $this->call(ProtectionTableSeeder::class);
        $this->call(TypeDevicesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        $this->call(TopicControlTypesTableSeeder::class);
        $this->call(TypeDeviceConfigurationsTableSeeder::class);
        $this->call(PricesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserPermissionsTableSeeder::class);
        $this->call(DisplaysTableSeeder::class);
        $this->call(ViewConfigurationsTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
        $this->call(DataReceptionsTableSeeder::class);
    }
}
