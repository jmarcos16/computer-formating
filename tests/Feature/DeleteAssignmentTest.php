<?php

it('should be able delete a assignment', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $assignment = \App\Models\Assignment::factory()->create();

    $this->delete(route('assignment.destroy', $assignment->id))
        ->assertRedirect(route('assignment.index'));

    $this->assertDatabaseMissing('assignments', [
        'id' => $assignment->id,
    ]);
});
