<?php

namespace App\Http\Controllers;

use App\Models\Single;

class PageController extends Controller
{
    public function index()
    {
        $record = Single::find(theme('home_page_id'));

        return view('templates.home', [
            'record' => $record,
        ]);
    }

    public function show(Single $page)
    {
        return view('templates.single', compact('page'));
    }
}
