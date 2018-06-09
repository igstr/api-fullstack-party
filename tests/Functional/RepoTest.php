<?php

namespace Tests\Functional;

use App\Model\User;

class RepoTest extends TestCase
{
    /**
     * Test GET method
     *
     * @return void
     */
    public function testGet()
    {
        $this->be(new User());

        $this->get('api/v1/repo');
        $this->assertResponseOk();
        $this->seeJsonContains([ 'success' => true ]);
    }

    /**
     * Test GET method without access token
     *
     * @return void
     */
    public function testGetWithoutAccessToken()
    {
        $this->get('api/v1/repo');
        $this->assertResponseStatus(401);
        $this->seeJsonContains([ 'success' => false ]);
    }

    /**
     * Test GET method with access token
     *
     * @return void
     */
    public function testGetWithAccessToken()
    {
        $token = env('GITHUB_TEST_ACCESS_TOKEN');
        $this->get('api/v1/repo?access_token='.$token);
        $this->assertResponseOk();
        $this->seeJsonContains([ 'success' => true ]);
    }
}
