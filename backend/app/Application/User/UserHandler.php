<?php

namespace App\Application\User;
use App\Domain\User\UserRepository;
use App\Domain\User\User;
use App\Models\User as ModelsUser;

class UserHandler
{
    public function __construct(private UserRepository $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function getAllUsers(): array
    {
        $user = ModelsUser::all();
        if ($user->isEmpty()) {
            return [];
        }
        return $user->toArray(); 
    }

    public function createUser(User $user)
    {
        return $this->userRepository->createUser($user);
    }
}