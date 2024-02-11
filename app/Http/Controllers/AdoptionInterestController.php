<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdoptionInterestController extends Controller
{
    public function index()
    {
        return view('adoption-interests.index');
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
