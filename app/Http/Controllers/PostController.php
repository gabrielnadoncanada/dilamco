<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Entry;

class PostController extends Controller
{
    public function show(Collection $postType, Entry $post)
    {
        return view('templates.single', compact('post'));
    }
}
