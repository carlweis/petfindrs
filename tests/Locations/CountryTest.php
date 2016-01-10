<?php



class CountryTest extends TestCase
{
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
}