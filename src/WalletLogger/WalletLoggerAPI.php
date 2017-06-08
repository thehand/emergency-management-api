<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;
use Slim\App as Slim;
use Slim\Container;
use Slim\Http\Request;
use Slim\Middleware\TokenAuthentication;

class WalletLoggerAPI
{
    /** @var Slim $app */
    private $app;

    /** @var UsersController $this->authenticator */
    public $authenticator;

    public function __construct()
    {
        $this->registerSettings();
        $this->registerDependencies();

        $this->authenticator = function (Request $request, TokenAuthentication $tokenAuth) {
            $token = $tokenAuth->findToken($request);

            $user = (new UsersController($this->app->getContainer()['db']))->authToken($token);

            if (!$user) {
                throw new UnauthorizedException('Authentication Failed');
            }
        };

        $this->registerRouter();
    }

    private function registerSettings()
    {
        $settings = [];

        // Load settings
        if (file_exists(__DIR__ . '/../settings.php')) {
            require __DIR__ . '/../settings.php';
        } else {
            throw new \RuntimeException('Settings file is missing.');
        }

        $this->app = new Slim($settings);
    }

    private function registerDependencies()
    {
        $this->app->getContainer()['db'] = function (Container $c) {
            $capsule = new Manager();
            $capsule->addConnection($c->get('dbConnection'));

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        };

        $this->app->getContainer()[UsersController::class] = function (Container $c) {
            return new UsersController($c->get('db'));
        };

        $this->app->getContainer()[WalletsController::class] = function (Container $c) {
            return new WalletsController($c->get('db'));
        };

        $this->app->getContainer()[AccountsController::class] = function (Container $c) {
            return new AccountsController($c->get('db'));
        };

        $this->app->getContainer()[TransactionsController::class] = function (Container $c) {
            return new TransactionsController($c->get('db'));
        };
    }

    private function registerRouter()
    {
        // Register routes
        $app = $this->get();
        if (file_exists(__DIR__ . '/../routes.php')) {
            require __DIR__ . '/../routes.php';
        } else {
            throw new \RuntimeException('Routes file is missing.');
        }
        $this->app = $app;
    }

    public function get()
    {
        return $this->app;
    }
}