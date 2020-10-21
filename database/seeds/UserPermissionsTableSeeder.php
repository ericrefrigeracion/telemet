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
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [5, 1]);
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [5, 2]);
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [4, 3]);


        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [1, 4]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [4, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [5, 4]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [10, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [11, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [12, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [13, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [14, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [15, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [16, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [17, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [18, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [19, 4]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [21, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [22, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [23, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [24, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [25, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [26, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [27, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [28, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [29, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [30, 4]);


        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [1, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [2, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [3, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [4, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [5, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [6, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [7, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [8, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [9, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [10, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [11, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [12, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [13, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [14, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [15, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [16, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [17, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [18, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [19, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [20, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [21, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [22, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [23, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [24, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [25, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [26, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [27, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [28, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [29, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [30, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [31, 1]);
    }
}
