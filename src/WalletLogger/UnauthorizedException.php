<?php

namespace WalletLogger;

use Slim\Middleware\TokenAuthentication\UnauthorizedExceptionInterface;

class UnauthorizedException extends \Exception implements UnauthorizedExceptionInterface
{

}