<?php

namespace WalletLogger;

use Illuminate\Support\Collection;
use Slim\Http\Request;
use Slim\Http\Response;
use WalletLogger\Interfaces\UsersControllerInterface;

class UsersController implements UsersControllerInterface
{
    private $model;

    public function __construct($db)
    {
        $this->model = new Users($db);
    }

    public function authToken($token)
    {
        /** @var Collection $user_data */
        $user_data = $this->model->getUserByToken($token);

        if ($user_data->count() === 1) {
            return $user_data->first();
        }

        throw new UnauthorizedException('Invalid token or user does not exists');
    }

    public function tryLogin(Request $request, Response $response, $args)
    {
        $post_data = $request->getParsedBody();

        /** @var Collection $user_data */
        $user_data = $this->model->getUserByCredentials($post_data['username'], $post_data['password']);

        if ($user_data->count() === 1) {
            return $response->withStatus(200)->withJson([
                'status' => 200,
                'message' => 'OK',
                'total_items' => $user_data->count(),
                'item' => $user_data->first()
            ]);
        }

        return $response->withStatus(401)->withJson([
            'status' => 401,
            'message' => 'Unauthorized'
        ]);
    }
}