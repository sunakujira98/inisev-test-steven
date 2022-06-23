<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 10; $i++) {
            Website::create([
                'name' => $faker->name,
            ]);
        }
    }
}
