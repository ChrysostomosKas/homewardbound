<?php

namespace App\Http\Controllers;

use App\Models\AdoptionAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdoptionAdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('admin')) {
            abort('403', "Access to this resource is forbidden.");
        }

        return view('adoption-ads.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adoption-ads.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdoptionAd $adoptionAd)
    {
        return view('adoption-ads.show', [
            'adoptionAd' => $adoptionAd
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $ad_id)
    {
        if (Gate::denies('admin')) {
            abort('403', "Access to this resource is forbidden.");
        }

        return view('adoption-ads.edit', [
            'ad_id' => $ad_id
        ]);
    }
}
