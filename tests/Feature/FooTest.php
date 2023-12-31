<?php

use App\Models\Foo;

function foo()
{
    return Foo::factory()->create();
}

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

it('should return 1 foo: /api/foos (json)', function () {
    foo();

    $response = $this->actingAs(user(), 'api')
        ->json('GET', '/api/foos');

    $response->assertStatus(200);

    expect($response->getData())
        ->toBeArray()
        ->toHaveCount(1);
});
