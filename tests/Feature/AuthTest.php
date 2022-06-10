<?php

it('ensure user can register', function () {
    $response = $this->postJson('/api/users/signup', [
        'user' => [
            "username" => "john",
            "email" => "john@mail.com",
            "encrypted_password" => "rahasia123",
            "phone" => "12345",
            "address" => "jl. test",
            "city" => "kota tua",
            "country" => "negara tua",
            "name" => "insomnia",
            "city" => "123",
            "postcode" => "94202"
        ]
    ]);

    $response->assertStatus(200);
});

it('ensure user can login', function () {
    $response = $this->postJson('/api/users/signin', [
        'email' => 'test@mail.com',
        "password" => "rahasia123",
    ]);

    $response->assertStatus(200);
});
