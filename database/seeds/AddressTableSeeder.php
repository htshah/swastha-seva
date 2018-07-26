<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('address')->insert([
            'street'    => '302, Girivihar, Shankar Lane',
            'address_2' => 'Ext. Orlem Tank Road, Malad(W)',
            'city'      => 'Mumbai',
            'state'     => 'Maharashtra',
            'pincode'   => 400064,
            'user_id'   => 1,
        ]);

    }
}
