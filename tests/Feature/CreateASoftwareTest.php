<?php

it('should be able create a software', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->post(route('software.store'), [
        'name'        => 'Software Name',
        'description' => 'Software Description',
        'link'        => 'https://software.com',
    ]);

    $response->assertRedirect(route('software.index'));
    $this->assertDatabaseHas('software', [
        'name'        => 'Software Name',
        'description' => 'Software Description',
        'link'        => 'https://software.com',
    ]);
});

test('validate if software name is required', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->post(route('software.store'), [
        'name'        => '',
        'description' => 'Software Description',
        'link'        => 'https://software.com',
    ]);

    $response->assertSessionHasErrors('name', 'The name field is required.');
});

test('validate if software name is string', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->post(route('software.store'), [
        'name'        => 123,
        'description' => 'Software Description',
        'link'        => 'https://software.com',
    ]);

    $response->assertSessionHasErrors('name', 'The name must be a string.');
});

test('validate if software name is max 55 characters', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->post(route('software.store'), [
        'name'        => str_repeat('a', 56),
        'description' => 'Software Description',
        'link'        => 'https://software.com',
    ]);

    $response->assertSessionHasErrors('name', 'The name must not be greater than 55 characters.');
});

test('validate if software description is required', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->post(route('software.store'), [
        'name'        => 'Software Name',
        'description' => '',
        'link'        => 'https://software.com',
    ]);

    $response->assertSessionHasErrors('description', 'The description field is required.');
});

test('validate if software description is string', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->post(route('software.store'), [
        'name'        => 'Software Name',
        'description' => 123,
        'link'        => 'https://software.com',
    ]);

    $response->assertSessionHasErrors('description', 'The description must be a string.');
});

test('validate if software description is max 255 characters', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->post(route('software.store'), [
        'name'        => 'Software Name',
        'description' => str_repeat('a', 256),
        'link'        => 'https://software.com',
    ]);

    $response->assertSessionHasErrors('description', 'The description must not be greater than 255 characters.');
});

test('validate if software link is url', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->post(route('software.store'), [
        'name'        => 'Software Name',
        'description' => 'Software Description',
        'link'        => 'software.com',
    ]);

    $response->assertSessionHasErrors('link', 'The link format is invalid.');
});

test('validate if software link is max 255 characters', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->post(route('software.store'), [
        'name'        => 'Software Name',
        'description' => 'Software Description',
        'link'        => str_repeat('a', 256),
    ]);

    $response->assertSessionHasErrors('link', 'The link must not be greater than 255 characters.');
});

test('validate return view create software', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = $this->get(route('software.create'));

    $response->assertViewIs('software.create');
});
