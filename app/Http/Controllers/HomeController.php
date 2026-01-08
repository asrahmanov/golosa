<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Tale;
use App\Models\Narrator;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredTales = Tale::with(['region', 'narrator'])
            ->where('is_published', true)
            ->where('is_featured', true)
            ->take(3)
            ->get();

        $regions = Region::withCount('tales')->get();
        
        $latestTales = Tale::with(['region', 'narrator'])
            ->where('is_published', true)
            ->latest()
            ->take(6)
            ->get();

        $narratorsCount = Narrator::count();
        $talesCount = Tale::where('is_published', true)->count();
        $regionsCount = Region::count();
        $totalListens = Tale::sum('listens');

        return view('home', compact(
            'featuredTales',
            'regions',
            'latestTales',
            'narratorsCount',
            'talesCount',
            'regionsCount',
            'totalListens'
        ));
    }

    public function about(): View
    {
        return view('about');
    }

    public function help(): View
    {
        return view('help');
    }

    public function contacts(): View
    {
        return view('contacts');
    }

    public function instructions(): View
    {
        return view('instructions');
    }

    public function opening(): View
    {
        return view('opening');
    }

    public function results(): View
    {
        return view('results');
    }
}

