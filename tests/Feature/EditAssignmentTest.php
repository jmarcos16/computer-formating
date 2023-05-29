<?php

test('validate return view edit assignment', function () {
    $user = \App\Models\User::factory()->create();
    auth()->login($user);

    $assignment = \App\Models\Assignment::factory()->create();

    $this->get(route('assignment.edit', $assignment->id))
        ->assertStatus(200)
        ->assertSee($assignment->name)
        ->assertSee($assignment->description);
});

it('should be able update assignment in database', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $assignment = \App\Models\Assignment::factory()->create();

    $this->put(route('assignment.update', $assignment->id), [
        'name' => 'New name',
        'description' => 'New description'
    ])->assertRedirect(route('assignment.index'));

    $this->assertDatabaseHas('assignments', [
        'name' => 'New name',
        'description' => 'New description'
    ]);
});

test('validate if name is required', function () {
    $user = \App\Models\User::factory()->create();
    auth()->login($user);

    $assignment = \App\Models\Assignment::factory()->create();

    $this->put(route('assignment.update', $assignment->id), [
        'name' => '',
        'description' => 'New description'
    ])->assertSessionHasErrors('name');
});

test('validate if description is string', function () {
    $user = \App\Models\User::factory()->create();
    auth()->login($user);

    $assignment = \App\Models\Assignment::factory()->create();

    $this->put(route('assignment.update', $assignment->id), [
        'name' => 'New name',
        'description' => 1362
    ])->assertSessionHasErrors('description');
});
