<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**@test */
    public function test_user_create()
    {
        $data = [
            'uId' => "asjd11982usakdj12",
            'name' => "Christian Alicaba",
            'phone_number' => "09565376522",
            'city' => "Cebu",
            'barangay' => "Catarman",
            'purok' => "Upo",
            'email' => "christiandave120702@gmail.com",
            'password' => "alicaba12345",
            'image' => "image.webp",
        ];

        $response = $this->postJson(route('users.store', $data));
        $response->assertStatus(201);
    }
}
