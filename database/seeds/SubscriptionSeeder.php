<?php

use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->insert([
            'name' => "Standard",
            'price' => 0,
        ]);
        DB::table('subscriptions')->insert([
            'name' => "COMPIS Basic",
            'diagnosis' => 1,
            'diagnosis_interval' => 3,
            'price' => 79.0,
        ]);
        DB::table('subscriptions')->insert([
            'name' => "COMPIS Silver",
            'diagnosis' => 1,
            'diagnosis_interval' => 3,
            'parts' => 1,
            'price' => 149.0,
        ]);
        DB::table('subscriptions')->insert([
            'name' => "COMPIS Titanium",
            'diagnosis' => 1,
            'diagnosis_interval' => 1,
            'parts' => 1,
            'upgrades' => 1,
            'support' => 1,
            'price' => 199.0,
        ]);
        DB::table('subscriptions')->insert([
            'name' => "COMPIS Gold",
            'diagnosis' => 1,
            'diagnosis_interval' => 1,
            'parts' => 1,
            'upgrades' => 1,
            'computers' => 1,
            'support' => 1,
            'price' => 949.0,
        ]);
    }
}