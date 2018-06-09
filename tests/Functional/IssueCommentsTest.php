<?php

namespace Tests\Functional;

use App\Model\User;

class IssueCommentsTest extends TestCase
{
    /**
     * Test GET method for single issue
     *
     * @return void
     */
    public function testGet()
    {
        $this->be(new User());

        $this->get('api/v1/issues/27551/comments');
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
        $this->get('api/v1/issues/27551/comments');
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
        $this->get('api/v1/issues/27551/comments?access_token='.$token);
        $this->assertResponseOk();
        $this->seeJsonContains([ 'success' => true ]);
    }
}