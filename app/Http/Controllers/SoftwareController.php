<?php

namespace App\Http\Controllers;

use App\Models\Software;

class SoftwareController extends Controller
{
    public function store()
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
