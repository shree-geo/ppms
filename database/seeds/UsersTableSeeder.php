<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $rows = [

            [
                'user_group_id' => 1,
                'name' => 'Young Minds',
                'email' => 'developer@youngminds.com.np',
                'password' => bcrypt('ymc123'),
                'designation_id' => 1,
                'user_status' => 'active',
            ],
            [
                'user_group_id' => 2,
                'name' => 'CSE User',
                'email' => 'cse@gmail.com',
                'password' => bcrypt('cse123'),
                'designation_id' => 1,
                'user_status' => 'active',
            ],
            [
                'user_group_id' => 3,
                'name' => 'DSMC User',
                'email' => 'regional@gmail.com',
                'password' => bcrypt('regional123'),
                'designation_id' => 1,
                'user_status' => 'active',
            ],
        ];

        DB::table('users')->insert($rows);
    }
}
