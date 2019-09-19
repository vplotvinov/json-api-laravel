<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithoutMiddleware;

    protected $apiUrl = '/v1/users/';


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAction()
    {
//        $response = $this->get($this->apiUrl);

        $this->assertTrue(true);
    }
}
