<?php

use Illuminate\Database\Seeder;

class RecipientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        \App\Recipient::create([
            'name' => 'Hellison',
            'email' => 'Hellison.oliveira@gmail.com'
        ]);

        for ($i = 0; $i < 50; $i++) {
            \App\Recipient::create([
                'name' => $faker->name,
                'email' => $faker->email
            ]);
        }
    }
}
