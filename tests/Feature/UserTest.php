<?php

use App\Models\User;

uses()->group('GET user calls');

it('should return 302 when not authenticated: /api/users', function () {
    $response = $this->get('/api/users');

    $response->assertStatus(302);
});

it('should return 401 when not authenticated: /api/users (json)', function () {
    $response = $this->json('GET', '/api/users');

    $response->assertStatus(401);
});

it('should return 200 when authenticated: /api/users (json)', function () {
    $response = $this->actingAs(user(), 'api')
        ->json('GET', '/api/users');

    $response->assertStatus(200);

    expect($response->getData())
        ->toBeArray();
});

it('should return user when authenticated: /api/users (json)', function () {
    $user = user();

    $response = $this->actingAs($user, 'api')
        ->json('GET', '/api/users/'.$user->id);

    $response->assertStatus(200);

    expect($response->getData())
        ->toBeObject()
        ->id->toBe($user->id)
        ->first_name->toBe($user->first_name)
        ->last_name->toBe($user->last_name)
        ->email->toBe($user->email)
        ->role->toBe($user->role);
});

it('should create new user', function () {
    $data = User::factory()->make();
    $response = $this->actingAs(user(), 'api')
        ->json('POST', '/api/users', array_merge($data->toArray(), [
            'password' => 'password',
        ]));

    $response->assertStatus(200);

    expect($response->getData())
        ->toBeObject()
        ->id->toBeInt()
        ->last_name->toBe($data->last_name)
        ->first_name->toBe($data->first_name)
        ->email->toBe($data->email)
        ->role->toBe($data->role);
});

it('should update current user', function () {
    $user = user();

    $data = User::factory()->make();
    $response = $this->actingAs($user, 'api')
        ->json('POST', '/api/users/'.$user->id, $data->toArray());

    $response->assertStatus(200);

    expect($response->getData())
        ->toBeObject()
        ->last_name->toBe($data->last_name)
        ->first_name->toBe($data->first_name)
        ->email->toBe($data->email)
        ->role->toBe($data->role);
});
