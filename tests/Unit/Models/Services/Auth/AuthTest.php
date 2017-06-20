<?php

namespace Test\Services\Auth;

use App\Services\Auth\Auth;
use Tests\BaseTestCase;

class AuthTest extends BaseTestCase
{
    /** @test */
    public function it_test_good()
    {
        \Mockery::mock()->
        $auth = new Auth('test');
        
        
        $this->assertTrue(false);
    }
}
