<?php
namespace database\seeds\Locations;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Reader;

class CountryTableSeeder extends Seeder
{
    /**
     * Seed the countries database table.
     *
     * @return void
     */
    public function run()
    {
        // clear the table before seeding
        DB::table('countries')->delete();

        // get the countries from the csv file
        $countriesCSV = Reader::createFromPath(database_path() . '/seeds/csv/countries.csv');
        $countries = $countriesCSV->fetchAll();
        $rowCount = 1;
        foreach ($countries as $row)
        {
            if (empty($row))
            {
                return;
            }

            if ($rowCount == 1)
            {
                $rowCount++;
                continue;
            }

            // insert the country into the database
            DB::table('countries')->insert([
                'code'       => $row[0],
                'latitude'   => $row[1],
                'longitude'  => $row[2],
                'name'       => $row[3],
                'slug'       => Str::slug($row[3]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        // enable the United States by default
        DB::table('countries')
            ->where('code', 'US')
            ->update(['active' => 1]);
    }
}