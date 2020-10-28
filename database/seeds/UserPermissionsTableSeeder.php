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

        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [2, 3]);
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [2, 4]);
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [2, 5]);
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [2, 6]);
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [2, 7]);
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [2, 8]);
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [2, 9]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [1, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [2, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [3, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [4, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [5, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [6, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [7, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [8, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [9, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [10, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [11, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [12, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [13, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [14, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [15, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [16, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [17, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [18, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [19, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [20, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [21, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [22, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [23, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [24, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [25, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [26, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [27, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [28, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [29, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [30, 2]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [32, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [33, 2]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [1, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [2, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [3, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [4, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [5, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [6, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [7, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [8, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [9, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [10, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [11, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [12, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [13, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [14, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [15, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [16, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [17, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [18, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [19, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [20, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [21, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [22, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [23, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [24, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [25, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [26, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [27, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [28, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [29, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [30, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [31, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [32, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [33, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [34, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [35, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [36, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [37, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [38, 3]);

    }
}
