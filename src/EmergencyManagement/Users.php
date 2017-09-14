<?php

namespace EmergencyManagement;

use Illuminate\Database\Capsule\Manager;
use EmergencyManagement\Interfaces\UsersModelInterface;

class Users implements UsersModelInterface
{
    protected $table;

    public function __construct(Manager $db)
    {
        $this->table = $db::table('users');
    }

    public function getUserByToken($token)
    {
        return $this->table->get()->where('device', $token);
    }

    public function getUserByCredentials($username, $password)
    {
        return $this->table->get()
            ->where('username', $username)
            ->where('password', $this->getMySQLPassword($password));
    }

    public function getMySQLPassword($plain_password)
    {
        return '*' . strtoupper(sha1(sha1($plain_password, true)));
    }
}