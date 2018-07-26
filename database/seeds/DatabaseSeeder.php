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
        $this->call(AddressTableSeeder::class);

        factory(\App\Users::class, 200)
            ->create()
            ->each(function ($user) {
                $user->address()
                    ->save(factory(\App\Address::class)->make());
            });
    }
}
