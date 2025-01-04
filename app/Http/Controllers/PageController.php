<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $record = Page::find(theme('home_page_id'));

        return view('templates.home', [
            'record' => $record,
        ]);
    }

    public function show(Page $page)
    {
        return view('templates.single', compact('page'));
    }
}
