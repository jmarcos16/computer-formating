<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Contracts\View\View;

class SoftwareController extends Controller
{
    public function index() : View
    {
        return view('software.index', [
            'softwares' => Software::query()
            ->latest()
            ->paginate(10),
        ]);
    }

    public function create() : View
    {
        return view('software.create');
    }

    public function store() : \Illuminate\Http\RedirectResponse
    {
        request()->validate([
            'name'        => ['required', 'string', 'max:55'],
            'description' => ['required', 'string', 'max:255'],
            'link'        => ['url', 'max:255'],
        ]);

        Software::query()->create([
            'name'        => request('name'),
            'description' => request('description'),
            'link'        => request('link'),
        ]);

        return redirect()->route('software.index');
    }
}
