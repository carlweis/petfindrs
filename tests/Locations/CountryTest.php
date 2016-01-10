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
}