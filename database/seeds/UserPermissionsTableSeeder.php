<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [1, 1]);
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [1, 2]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [10, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [12, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [14, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [15, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [16, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [17, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [18, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [20, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [21, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [22, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [23, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [24, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [25, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [26, 3]);
    }
}
