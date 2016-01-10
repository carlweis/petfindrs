<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class CountryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function can_retrieve_all_countries()
    {
        $response = $this->call('GET', 'v1/locations/countries');
        return $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function all_countries_contains_united_states()
    {
        return $this->get('/v1/locations/countries')
            ->seeJson(['name' => 'United States', 'code' => 'US']);
    }

    /**
     * @test
     */
    public function can_retrieve_all_active_countries()
    {
        $response = $this->call('GET', 'v1/locations/countries/active');
        return $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function can_retrieve_country_by_id()
    {
        return $this->get('v1/locations/countries/2')
                    ->seeJson(['name' => 'United Arab Emirates', 'code' => 'AE']);

    }

    /**
     * @test
     */
    public function can_retrieve_country_by_code()
    {
        return $this->get('/v1/locations/countries/code/US')
            ->seeJson(['name' => 'United States', 'code' => 'US']);
    }

    /**
     * @test
     */
    public function can_retrieve_country_by_name()
    {
        $response = $this->call('GET', 'v1/locations/countries/name/united%20states');
        return $this->seeJson(['name' => 'United States', 'code' => 'US'])
                    ->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function can_retrieve_country_by_latitude_and_longitude()
    {
        $response = $this->call('GET',
            'v1/locations/countries/lat/-25.27439800/lon/133.77513600');
        return  $this->assertEquals(200, $response->getStatusCode());
    }
}