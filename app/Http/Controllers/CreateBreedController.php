<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CreateBreedController extends Controller
{
    /**
     * Show the form for creating a new breed.
     */
    public function create($breed_type)
    {
        if (Gate::denies('admin')) {
            abort('403', "Access to this resource is forbidden.");
        }

        return view('breeds.create', [
            'breed_category' => $breed_type
        ]);
    }
}
