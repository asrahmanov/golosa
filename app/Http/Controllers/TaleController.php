<?php

namespace App\Http\Controllers;

use App\Models\Tale;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaleController extends Controller
{
    public function index(Request $request): View
    {
        // Пока проект в разработке - показываем страницу "скоро"
        return view('tales.index');
    }

    public function show(Tale $tale): View
    {
        // Пока проект в разработке - показываем страницу "скоро"
        return view('tales.show');
    }
}
