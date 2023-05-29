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
            'name' => ['required', 'string', 'max:255']
        ]);

        Assignment::query()->create([
            'name' => $request->get('name')
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

        request()->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $assignment->update([
            'name' => request('name'),
        ]);

        return redirect()->route('assignment.index');
    }
}
