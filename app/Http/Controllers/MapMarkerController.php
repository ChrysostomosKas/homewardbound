<?php

namespace App\Http\Controllers;

use App\Jobs\AddMarkerJob;
use App\Jobs\InformSupportUsersJob;
use App\Models\MapMarker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MapMarkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('maps.index');
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
    public function store(Request $request)
    {
        $requestData = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
            $requestData['image'] = $fileName;
        }

        dispatch(new AddMarkerJob($requestData));
        dispatch(new InformSupportUsersJob($requestData['contact_phone_number']));

        return response()->json(['message' => 'Your changes have been successfully saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(MapMarker $mapMarker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MapMarker $mapMarker)
    {
        //
    }

    /**
     *
     */
    public function requestIndex()
    {
        if (Gate::denies('admin')) {
            abort('403', "Access to this resource is forbidden.");
        }

        return view('maps.requestIndex');
    }
}
