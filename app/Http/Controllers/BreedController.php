<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BreedController extends Controller
{
    public function index()
    {
        if (Gate::denies('admin')) {
            abort('403', "Access to this resource is forbidden.");
        }

        return view('forms.breeds.index');
    }

    public function create()
    {
        if (Gate::denies('administrate')) {
            abort('403', "Δεν έχετε πρόσβαση");
        }

        return view('forms.breeds.create');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, $slug)
    {
        if (Gate::denies('admin')) {
            abort('403', "Access to this resource is forbidden.");
        }
        return view('forms.breeds.edit', [
            'slug' => $slug,
            'breed_type' => $request->get('breed_type')
        ]);
    }
}
