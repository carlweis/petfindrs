<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class DefaultTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/')
            ->seeJson([
                'name'       => 'PetFindrs API',
                'version'    => '1.0',
                'statusCode' => 200
            ]);
    }
}
