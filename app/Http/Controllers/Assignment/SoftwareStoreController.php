<?php

namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;

class SoftwareStoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Assignment $assignment): \Illuminate\Http\RedirectResponse
    {
        request()->validate([
            'software_id' => ['required', 'exists:software,id']
        ]);

        $assignment->setSoftware(request('software_id'));

        return back();
    }
}
