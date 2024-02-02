<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('medical-records.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medical-records.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        return view('medical-records.edit', [
            'medicalRecordId' => $medicalRecord->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        try {
            DB::beginTransaction();

            $medicalRecord->delete();

            DB::commit();

            return response()->json(['message' => 'Medical Record deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to delete medical record. Please try again.']);
        }
    }
}
