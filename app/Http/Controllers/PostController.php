<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

/**
 * Post Managed Controller
 * This controller handles the front end interactions with a model, editing and
 * managing is done via the filament admin resource PostResource.php
 * where you can define the form schema and input validation for the model.
 */
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Post::all();

        return view('Post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('Post.show');
    }
}
