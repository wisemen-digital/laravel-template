<?php

use App\Models\Foo;

it('should return 302 when not authenticated: /api/foos', function () {
    $response = $this->get('/api/foos');

    $response->assertStatus(302);
});

it('should return 401 when not authenticated: /api/foos (json)', function () {
    $response = $this->json('GET', '/api/foos');

    $response->assertStatus(401);
});

it('should return 200 when authenticated: /api/foos (json)', function () {
    $response = $this->actingAs(user(), 'api')
        ->json('GET', '/api/foos');

    $response->assertStatus(200);

    expect($response->getData())
        ->toBeArray();
});

it('should return user when authenticated: /api/foos (json)', function () {
    $foo = Foo::factory()->create();

    $response = $this->actingAs(user(), 'api')
        ->json('GET', '/api/foos/'.$foo->id);

    $response->assertStatus(200);

    expect($response->getData())
        ->toBeObject()
        ->id->toBe($foo->id)
        ->name->toBe($foo->name);
});

it('should create new user', function () {
    $data = Foo::factory()->make();
    $response = $this->actingAs(user(), 'api')
        ->json('POST', '/api/foos', $data->toArray());

    $response->assertStatus(200);

    expect($response->getData())
        ->toBeObject()
        ->id->toBeInt()
        ->name->toBe($data->name);
});

it('should update current user', function () {
    $foo = Foo::factory()->create();

    $data = Foo::factory()->make();
    $response = $this->actingAs(user(), 'api')
        ->json('POST', '/api/foos/'.$foo->id, $data->toArray());

    $response->assertStatus(200);

    expect($response->getData())
        ->toBeObject()
        ->name->toBe($data->name);
});
