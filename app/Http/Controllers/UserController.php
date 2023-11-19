<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        if (Gate::denies('admin')) {
            abort('403', "Access to this resource is forbidden.");
        }

        return view('forms.users.index');
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        //
    }
}
