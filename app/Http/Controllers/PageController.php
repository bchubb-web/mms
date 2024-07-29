<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

/**
 * Page Managed Controller
 * This controller handles the front end interactions with a model, editing and
 * managing is done via the filament admin resource PageResource.php
 * where you can define the form schema and input validation for the model.
 */
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Page::all();

        return view('Page.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('Page.show');
    }
}
