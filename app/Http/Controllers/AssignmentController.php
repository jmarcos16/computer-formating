<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{

    public function index() : \Illuminate\Contracts\View\View
    {
        return view('assignment.index', [
            'assignments' => Assignment::query()->paginate(10)
        ]);
    }


    public  function  create() : \Illuminate\Contracts\View\View
    {
        return view('assignment.create');
    }

    public function store(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255']
        ]);


        Assignment::query()->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('assignment.index');
    }
}
