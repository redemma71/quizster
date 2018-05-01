<?php

use Illuminate\Database\Seeder;
use App\Jobs;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Jobs::create([
                'jobName' => $faker->title,
                'jobDescription' => $faker->paragraph,
                'jobUrl' => $faker->url,
                'jobType' => $faker->stateAbbr
            ]);
        }
    }
}