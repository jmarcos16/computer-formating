<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssingnmentController extends Controller
{
    public function store(Request $request)
    {
        Assignment::query()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('assignment.index');
    }
}
