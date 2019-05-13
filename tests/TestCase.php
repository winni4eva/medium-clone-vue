<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use App\User;
use JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;

    protected $clientToken;

    protected $client;

    public function setUp(): void
    {
        parent::setUp();
    }

    private function setClientToken()
    {
        $client = factory(User::class)->create();

        $this->client = $client;
        $this->clientToken = JWTAuth::fromUser($client);

        // $this->refreshApplication();
    }

    public function clientGet($url, $data = [])
    {
        $this->setClientToken();
        $url .= '?token=' . $this->clientToken;
        return $this->get($url, $data);
    }

    public function clientPost($url, $data = [])
    {
        $this->setClientToken();
        $url .= '?token=' . $this->clientToken;
        return $this->post($url, $data);
    }
}
