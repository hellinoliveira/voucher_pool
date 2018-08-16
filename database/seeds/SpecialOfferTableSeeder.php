<?php

use Illuminate\Database\Seeder;

class SpecialOfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            \App\SpecialOffer::create([
                'name' => $faker->domainName,
                'percentage_discount' => $faker->randomFloat(null, 1, 100)
            ]);
        }
    }
}
