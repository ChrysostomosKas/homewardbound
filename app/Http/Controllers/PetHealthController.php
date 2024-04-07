<?php

namespace App\Http\Controllers;

use App\Models\PetHealth;
use Illuminate\Http\Request;

class PetHealthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('petHeath.create', [
            'pet_id' => $request->get('pet_id')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PetHealth $petHealth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PetHealth $petHealth)
    {
        return view('petHeath.edit', [
            'pet_health_id' => $petHealth->id,
            'pet_id' => $petHealth->pet_id
        ]);
    }
}
