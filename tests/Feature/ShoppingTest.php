<?php

use Illuminate\Support\Facades\Auth;

it("ensure user can't see shopping if not authenticated", function () {
    $response = $this->getJson('/api/shopping');
    $response->assertStatus(401);
});

it("ensure user can see shopping if authenticated", function () {
    Auth::guard('api')->attempt(['email' => 'test@mail.com', 'password' => 'rahasia123']);
    $res = $this->getJson('/api/shopping');
    $res->assertStatus(200);
});
