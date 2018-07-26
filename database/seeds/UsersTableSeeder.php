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
        DB::table('users')->insert([
            'name' => 'Het Shah',
            'mobile' => '+919022340657',
            'email' => 'htshah60@gmail.com',
            'aadhar' => '123465798123',
            'dob' => '1997-11-20',
        ]);
    }
}
