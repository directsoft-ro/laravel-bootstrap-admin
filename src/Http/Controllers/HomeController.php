<?php

namespace DirectsoftRo\LaravelBootstrapAdmin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('admin::home');
    }
}
