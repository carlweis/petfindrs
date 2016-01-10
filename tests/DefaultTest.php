<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class DefaultTest extends TestCase
{
    /**
     * Test to make sure we can hit the root url.
     *
     * @test
     * @return void
     */
    public function can_return_api_version()
    {
        $this->get('/')
            ->seeJson([
                'name'       => 'PetFindrs API',
                'version'    => '1.0',
                'statusCode' => 200
            ]);
    }
}
