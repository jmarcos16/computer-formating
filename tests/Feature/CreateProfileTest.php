<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able create a assignment.', function () {
    $user= User::factory()->create();
    actingAs($user);

    $response = post(route('assignment.store'), [
        'name' => 'Assignment 1',
        'description' => 'Description 1',
    ]);

    $response->assertRedirect(route('assignment.index'));
    assertDatabaseCount('assignments', 1);
    assertDatabaseHas('assignments', [
        'name' => 'Assignment 1',
        'description' => 'Description 1',
    ]);
});

test('validate if name is required', function () {

    $user= User::factory()->create();
    actingAs($user);

    $response = post(route('assignment.store'), [
        'name' => '',
        'description' => 'Description 1',
    ]);

    $response->assertSessionHasErrors('name');
    assertDatabaseCount('assignments', 0);
});


test('validate if name is string', function () {

    $user= User::factory()->create();
    actingAs($user);

    $response = post(route('assignment.store'), [
        'name' => 123,
        'description' => 'Description 1',
    ]);

    $response->assertSessionHasErrors('name');
    assertDatabaseCount('assignments', 0);
});



