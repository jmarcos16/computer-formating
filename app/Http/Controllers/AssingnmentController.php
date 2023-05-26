<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssingnmentController extends Controller
{

    public  function  create()
    {
        return view('assignment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255']
        ]);


        Assignment::query()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('assignment.index');
    }
}
