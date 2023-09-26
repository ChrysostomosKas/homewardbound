<?php

namespace App\Http\Controllers;

use App\Models\DogBreed;
use App\Http\Requests\StoreDogBreedRequest;
use App\Http\Requests\UpdateDogBreedRequest;

class DogBreedController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDogBreedRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DogBreed $dogBreed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DogBreed $dogBreed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDogBreedRequest $request, DogBreed $dogBreed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DogBreed $dogBreed)
    {
        //
    }
}
