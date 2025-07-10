<?php

namespace App\Domain\User;

interface UserRepository
{
    public function getAllUsers(): array;
    public function createUser(User $user);

}