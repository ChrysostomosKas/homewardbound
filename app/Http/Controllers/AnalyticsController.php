<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class AnalyticsController extends Controller
{
    public function index()
    {
        if (Gate::denies('admin')) {
            abort('403', "Access to this resource is forbidden.");
        }

        return view('analytics.index');
    }
}
