<?php

namespace App\Http\Controllers;

use App\Models\Formatation;
use Illuminate\Http\Request;

class FormatationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $formatation = Formatation::query()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard');
    }
}
