<?php

namespace EmergencyManagement\Interfaces;

interface UsersModelInterface
{
    public function getMySQLPassword($plain_password);

    public function getUserByToken($token);

    public function getUserByCredentials($username, $password);
}