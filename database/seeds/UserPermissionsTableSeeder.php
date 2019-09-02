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

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [100, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [102, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [104, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [105, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [106, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [110, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [111, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [120, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [121, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [122, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [123, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [130, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [131, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [132, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [140, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [141, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [142, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [143, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [144, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [244, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [245, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [301, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [302, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [303, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [304, 3]);

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [100, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [102, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [110, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [111, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [120, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [121, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [122, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [123, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [140, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [141, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [244, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [301, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [302, 4]);

    }
}
