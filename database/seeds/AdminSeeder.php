<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Address;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = Address::create();
        User::create([
            'uuid' => Str::uuid(),
            'phone_number' => "0735749353",
            'name' => 'Sinisha Stojchevski',
            'email' => 'stojchevski0@gmail.com',
            'password' => bcrypt('familjen1'),
            'admin' => 1,
            'subscription_id' => 1,
            'address_id' => $address->id
        ]);
        // DB::table('users')->insert([

        // ]);
    }
}
