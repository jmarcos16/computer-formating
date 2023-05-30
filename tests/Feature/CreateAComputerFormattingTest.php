<?php

it('should be able create a new formatting', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $assignment = \App\Models\Assignment::factory()->create();

    $response = \Pest\Laravel\post(route('computer.formatting.store'), [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);

    \Pest\Laravel\assertDatabaseCount('computer_formatting', 1);
    \Pest\Laravel\assertDatabaseHas('computer_formatting', [
        'computer_name'   => 'Test Computer',
        'computer_status' => 'new',
        'computer_type'   => 'desktop',
        'assignment_id'   => $assignment->id,
        'situation'       => 'pending',
    ]);
});
