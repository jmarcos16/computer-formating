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
