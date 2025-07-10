<?php

namespace App\Infrastructure\Eloquent\User;
use App\Domain\User\User;
use App\Domain\User\UserRepository;
use App\Models\User as ModelsUser;

class EloquentUserRepository implements UserRepository
{
    public function getAllUsers(): array
    {
        $users = \App\Models\User::all();
        if ($users->isEmpty()) {
            return [];
        }
        return $users->toArray();
    }

    public function createUser(User $user)
    {
        $ModelsUser = ModelsUser::find($user->getId()) ?? new ModelsUser();
        $ModelsUser->id = $user->getId();
        $ModelsUser->name = $user->getName();
        $ModelsUser->phone_number = $user->getPhoneNumber();
        $ModelsUser->city = $user->getCity();
        $ModelsUser->barangay = $user->getBarangay();
        $ModelsUser->purok = $user->getPurok();
        $ModelsUser->email = $user->getEmail();
        $ModelsUser->password = $user->getPassword();
        $ModelsUser->image = $user->getImage();
        $ModelsUser->save();
    }
}