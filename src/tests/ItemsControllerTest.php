<?php

use Slim\Http\Environment;
use Slim\Http\Request;
use WalletLogger\WalletLoggerAPI;

class ItemsControllerTest extends PHPUnit_Framework_TestCase
{
    /** @var Slim\App app */
    protected $app;

    public function setUp()
    {
        $this->app = (new WalletLoggerAPI())->get();
    }

    private function callApi($env)
    {
        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;
        return $this->app->run(true);
    }

    public function testSetUp()
    {
        $this->assertEquals(Slim\App::class, get_class($this->app));
    }

    public function testListWallets()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/wallets',
        ]);
        $response = $this->callApi($env);
        $response_body = json_decode($response->getBody());

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertSame($response_body->status, 200);
    }

    public function testListAccounts()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/wallets/1/accounts',
        ]);
        $response = $this->callApi($env);
        $response_body = json_decode($response->getBody());

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertSame($response_body->status, 200);
    }

    public function testListTransactions()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/wallets/1/accounts/1/transactions',
        ]);
        $response = $this->callApi($env);
        $response_body = json_decode($response->getBody());

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertSame($response_body->status, 200);
    }

    public function testCreateItem()
    {
        $this->assertTrue(false);
    }

    public function testUpdateItem()
    {
        $this->assertTrue(false);
    }

    public function testDeleteItem()
    {
        $this->assertTrue(false);
    }

    public function testReturnBadRequestError()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'OPTIONS',
            'REQUEST_URI' => '/wallets',
        ]);
        $response = $this->callApi($env);

        $this->assertSame($response->getStatusCode(), 400);
    }

    public function testReturnNotFound()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/wallets/0',
        ]);
        $response = $this->callApi($env);

        $this->assertSame($response->getStatusCode(), 404);
    }

    public function testReturnServerError()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/wallets',
        ]);
        $response = $this->callApi($env);

        $this->assertSame($response->getStatusCode(), 500);
    }
}