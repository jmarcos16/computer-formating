<?php

use App\Models\Assignment;
use App\Models\Software;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('it should be able relation a software with a assignments.', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();
    $software   = Software::factory()->create();

    $response = $this->post(route('assignment.software.store', $assignment), [
        'software_id' => $software->id,
    ]);

    \Pest\Laravel\assertDatabaseCount('assignment_software', 1);
    \Pest\Laravel\assertDatabaseHas('assignment_software', [
        'assignment_id' => $assignment->id,
        'software_id'   => $software->id,
    ]);
});

test('validates if the software already exists ', function () {
    $user = User::factory()->create();
    actingAs($user);

    $assignment = Assignment::factory()->create();
    $software   = Software::factory()->create();

    \Pest\Laravel\post(route('assignment.software.store', $assignment), [
        'software_id' => $software->id,
    ]);
    \Pest\Laravel\post(route('assignment.software.store', $assignment), [
        'software_id' => $software->id,
    ]);

    \Pest\Laravel\assertDatabaseCount('assignment_software', 1);
    \Pest\Laravel\assertDatabaseHas('assignment_software', [
        'assignment_id' => $assignment->id,
        'software_id'   => $software->id,
    ]);
});
