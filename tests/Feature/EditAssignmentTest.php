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

//it('shwo', function () {
//
//});
