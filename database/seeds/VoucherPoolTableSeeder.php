<?php

use Illuminate\Database\Seeder;

class VoucherPoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $recipients_id = \App\Recipient::all()->pluck('id')->toArray();
        $offer_id = \App\SpecialOffer::all()->pluck('id')->toArray();


        \App\VoucherPool::create([
            'code' => '12345678',
            'expires_at' => $faker->dateTimeBetween('now', '+30days'),
            'recipient_id' => '1',
            'special_offer_id' => $faker->randomElement($offer_id)
        ]);

        for ($i = 0; $i < 50; $i++) {
            \App\VoucherPool::create([
                'code' => $faker->randomNumber(8),
                'expires_at' => $faker->dateTimeBetween('now', '+30days'),
                'recipient_id' => $faker->randomElement($recipients_id),
                'special_offer_id' => $faker->randomElement($offer_id)
            ]);
        }
    }
}
