<?php

namespace App\Http\Controllers;

use App\Models\ComputerFormatting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ComputerFormattingController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'computer_name'   => ['required', 'max:50'],
            'computer_status' => ['required', 'in:new,used', 'max:50'],
            'computer_type'   => ['required', 'in:desktop,notebook', 'max:50'],
            'assignment_id'   => ['required', 'exists:assignments,id', 'max:50'],
            'situation'       => ['required', 'in:pending,completed', 'max:50'],
        ]);

        ComputerFormatting::query()->create([
            'computer_name'   => $request->get('computer_name'),
            'computer_status' => $request->get('computer_status'),
            'computer_type'   => $request->get('computer_type'),
            'assignment_id'   => $request->get('assignment_id'),
            'situation'       => $request->get('situation')
        ]);

        return redirect()->route('dashboard');
    }
}
