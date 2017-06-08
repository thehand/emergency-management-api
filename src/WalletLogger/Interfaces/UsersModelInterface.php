<?php

namespace WalletLogger\Interfaces;

interface UsersModelInterface
{
    public function getMySQLPassword($plain_password);

    public function getUserByToken($token);

    public function getUserByCredentials($username, $password);
}