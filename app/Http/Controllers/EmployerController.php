<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;

class EmployerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $employer = Employer::create([
            'name' => $request->name,
        ]);

        return redirect()->route('employers.show', $employer);
    }

    public function create()
    {
        return view('employers.create');
    }
}

