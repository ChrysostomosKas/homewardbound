<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreedController extends Controller
{
    public function index()
    {
//        if (Gate::denies('admin')) {
//            abort('403', ""Access to this resource is forbidden.");
//        }

        return view('forms.breed-form-index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
}
