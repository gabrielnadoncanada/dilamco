<?php

namespace App\Http\Controllers;

use App\Models\Entry as BlogPost;
use App\Services\DataService;

class HomeController extends Controller
{
    protected DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function index()
    {
        $bannerOne = $this->dataService->getData('banner');
        $teams = $this->dataService->getData('team');
        $projects = $this->dataService->getData('project');
        $services = $this->dataService->getData('service');
        $products = $this->dataService->getData('product');
        $blogs = BlogPost::all()->take(4);

        return view('home', compact('bannerOne', 'teams', 'projects', 'services', 'blogs', 'products'));
    }
}
