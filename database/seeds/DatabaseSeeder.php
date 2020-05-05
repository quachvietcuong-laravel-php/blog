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
        // $this->call(UserSeeder::class);
        // $this->call(AdminTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
    }

}
class AdminTableSeeder extends Seeder
{
     public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name'     => 'Clone 1' ,
                    'email'    => 'clone1@gmail.com' , 
                    'password' => bcrypt('123456') ,
                ],
                [
                    'name'     => 'Clone 2' ,
                    'email'    => 'clone2@gmail.com' , 
                    'password' => bcrypt('123456') ,
                ],
            ]
        );
    }
}

class CustomersTableSeeder extends Seeder
{
     public function run()
    {
        DB::table('tbl_customers')->insert(
            [
                [
                    'name'     => 'user 1' ,
                    'email'    => 'user1@gmail.com' , 
                    'password' => md5('123456') ,
                    'phone' => '0909354210',
                ],
                [
                    'name'     => 'user 2' ,
                    'email'    => 'user2@gmail.com' , 
                    'password' => md5('123456') ,
                    'phone' => '0908354210',
                ],
                [
                    'name'     => 'user 3' ,
                    'email'    => 'user3@gmail.com' , 
                    'password' => md5('123456') ,
                    'phone' => '0908354211',
                ],
            ]
        );
    }
}