<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed the countries database table
        $this->call('database\seeds\Locations\CountryTableSeeder');
    }
}
