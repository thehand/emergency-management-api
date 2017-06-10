<?php

namespace WalletLogger\Interfaces;

use Slim\Http\Request;
use Slim\Http\Response;

interface UsersControllerInterface
{
    public function authToken($token);

    public function tryLogin(Request $request, Response $response, $args);
}