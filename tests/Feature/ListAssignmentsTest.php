<?php


it('should be able all assignments', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $response = \Pest\Laravel\get(route('assignment.index'));
    $response->assertOk();
    $response->assertViewIs('assignment.index');
});

test('validate select all assignments', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $assignment = \App\Models\Assignment::factory()->count(10)->create();

    $response = \Pest\Laravel\get(route('assignment.index'));
    $response->assertOk();
    $response->assertViewIs('assignment.index');
    $response->assertSee($assignment->first()->name);
    $response->assertSee($assignment->first()->description);
});
