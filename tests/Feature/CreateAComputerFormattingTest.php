<?php

use App\Models\Assignment;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able create a new formatting', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    assertDatabaseCount('computer_formatting', 1);
    assertDatabaseHas('computer_formatting', [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);
});

test('computer_name is required', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => '',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('computer_name');
});

test('computer_name is max 50 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => str_repeat('a', 51),
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('computer_name');
});

test('computer_status is required', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => '',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('computer_status');
});

test('computer_status is in new or used', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'invalid',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('computer_status');
});

test('computer_status is max 50 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => str_repeat('a', 51),
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('computer_status');
});

test('computer_type is required', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => '',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('computer_type');
});

test('computer_type is in desktop or laptop', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'invalid',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('computer_type');
});

test('computer_type is max 50 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => str_repeat('a', 51),
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('computer_type');
});

test('assignment_id is required', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => '',
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('assignment_id');
});

test('assignment_id is an integer', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => 'invalid',
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('assignment_id');
});

test('assignment_id is a valid assignment id', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => 1,
        'situation'       => 'pending',
    ]);

    $response->assertSessionHasErrors('assignment_id');
});

test('situation is required', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => '',
    ]);

    $response->assertSessionHasErrors('situation');
});

test('situation is in pending or complete', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'invalid',
    ]);

    $response->assertSessionHasErrors('situation');
});

test('situation is max 50 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();

    $response = post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => str_repeat('a', 51),
    ]);

    $response->assertSessionHasErrors('situation');
});
