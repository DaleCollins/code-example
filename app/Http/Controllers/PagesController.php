<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    public function show($page = null)
    {
        // If no page is passed, default to index
        $page = $page ?? 'index';
        // Switch from the default frontend view directory (pages) for auth views
        $directory = in_array($page, ['login','register']) ? 'auth' : 'pages';
        // return the view if it exists or a 404 page
        return View::exists($directory.'.'.$page) ? view($directory.'.'.$page) : abort(404);
    }
}
