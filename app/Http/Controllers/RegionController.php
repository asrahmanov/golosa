<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\View\View;

class RegionController extends Controller
{
    public function index(): View
    {
        $regions = Region::withCount('tales')->get();

        return view('regions.index', compact('regions'));
    }

    public function show(Region $region): View
    {
        $region->load(['tales' => function ($query) {
            $query->with(['narrator'])
                ->where('is_published', true)
                ->latest();
        }]);

        return view('regions.show', compact('region'));
    }
}





