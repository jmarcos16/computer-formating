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
    public function __invoke(Assignment $assignment)
    {
        $assignment->setSoftware(request('software_id'));

        return back();
    }
}
