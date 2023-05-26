<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('should be able create a formatation', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = $this->post(route('formatation.create'), [
        'title' => 'Formatation Test',
        'description' => 'Formatation Test',
        'status' => 'pending',
    ])->assertRedirect(route('dashboard'));

    assertDatabaseCount('formatations', 1);
    assertDatabaseHas('formatations', [
        'title' => 'Formatation Test',
        'description' => 'Formatation Test',
        'status' => 'pending',
    ]);
});

test('validade if status contains pending, approved or rejected', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = $this->post(route('formatation.create'), [
        'title' => 'Formatation Test',
        'description' => 'Formatation Test',
        'status' => 'invalid status',
    ]);

    $response->assertSessionHasErrors('status');
    assertDatabaseCount('formatations', 0);
});

test('validate if title is required', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = $this->post(route('formatation.create'), [
        'title' => '',
        'description' => 'Formatation Test',
        'status' => 'pending',
    ]);

    $response->assertSessionHasErrors('title');
    assertDatabaseCount('formatations', 0);
});
