<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(): View
    {
        return view('assignment.index', [
            'assignments' => Assignment::query()->paginate(1)
        ]);
    }

    public function create(): View
    {
        return view('assignment.create');
    }

    public function store(Request $request): RedirectResponse
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

    public function edit(Assignment $assignment): View
    {
        return view('assignment.edit', [
            'assignment' => $assignment
        ]);
    }

    public function update(Assignment $assignment): RedirectResponse
    {
        $assignment->update([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return redirect()->route('assignment.index');
    }
}
