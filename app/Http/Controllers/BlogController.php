<?php

namespace App\Http\Controllers;

use App\Models\Entry as BlogPost;
use App\Services\DataService;

class BlogController extends Controller
{
    protected DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function show($slug = null)
    {

        if ($slug) {
            $blogPost = BlogPost::where('slug', $slug)->published()->first();

            if ($blogPost) {
                $record = $blogPost;
            }
        }

        return view('templates.single', [
            'record' => $record,
        ]);
    }
}
