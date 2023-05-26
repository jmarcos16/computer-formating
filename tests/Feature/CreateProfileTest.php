<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;


test('validate if return is ok', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = \Pest\Laravel\get(route('assignment.create'));
    $response->assertOk();
    $response->assertViewIs('assignment.create');
});


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

    $response->assertSessionHasErrors('name', 'The name field is required.');
    assertDatabaseCount('assignments', 0);
});


test('validate if name is string', function () {

    $user= User::factory()->create();
    actingAs($user);

    $response = post(route('assignment.store'), [
        'name' => 123,
        'description' => 'Description 1',
    ]);

    $response->assertSessionHasErrors('name', 'The name must be a string.');
    assertDatabaseCount('assignments', 0);
});


test('validate if supported max 255 characters', function () {

    $user= User::factory()->create();
    actingAs($user);

    $response = post(route('assignment.store'), [
        'name' => '*'.str_repeat('a', 256),
        'description' => 'Description 1',
    ]);

    $response->assertSessionHasErrors('name', 'The name may not be greater than 255 characters.');
    assertDatabaseCount('assignments', 0);
});

test('validate if description is string', function () {

    $user= User::factory()->create();
    actingAs($user);

    $response = post(route('assignment.store'), [
        'name' => 'Assignment 1',
        'description' => 123,
    ]);

    $response->assertSessionHasErrors('description', 'The description must be a string.');
    assertDatabaseCount('assignments', 0);
});

test('validate if description supported max 255 characters', function () {

    $user= User::factory()->create();
    actingAs($user);

    $response = post(route('assignment.store'), [
        'name' => 'Assignment 1',
        'description' => '*'.str_repeat('a', 256),
    ]);

    $response->assertSessionHasErrors('description', 'The description may not be greater than 255 characters.');
    assertDatabaseCount('assignments', 0);
});


