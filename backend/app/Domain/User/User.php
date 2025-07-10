<?php

namespace App\Domain\User;

class User
{
    public function __construct(
        private int $id,
        private string $name,
        private ?string $phone_number = null,
        private ?string $city = null,
        private ?string $barangay = null,
        private ?string $purok = null,
        private string $email,
        private string $password,
        private ?string $image = null
    ){
        $this->id = $id;
        $this->name = $name;
        $this->phone_number = $phone_number;
        $this->city = $city;
        $this->barangay = $barangay;
        $this->purok = $purok;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
    public function getBarangay(): ?string
    {
        return $this->barangay;
    }

    public function getPurok(): ?string
    {
        return $this->purok;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }
}
