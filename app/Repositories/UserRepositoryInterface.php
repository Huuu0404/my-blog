<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function checkUserName($user_name);
    public function checkEmail($email);
    public function createUser($user_name, $email, $password);
    public function getUserByEmail($email);
    public function getUserNameByUserId($user_id);
}