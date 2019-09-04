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
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [4, 3]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [1, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [3, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [5, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [6, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [7, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [8, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [9, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [11, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [12, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [13, 3]);
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
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [44, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [45, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [52, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [53, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [54, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [55, 3]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [1, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [3, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [8, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [9, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [11, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [12, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [13, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [14, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [16, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [17, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [20, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [21, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [44, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [52, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [53, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [54, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [55, 4]);
    }
}
