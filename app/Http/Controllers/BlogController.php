<?php

namespace App\Http\Controllers;

use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Views/Blog');
    }

    public function addBlog ()
    {
        return Inertia::render('Admin/Views/AddBlog');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'coverPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->coverPhoto->extension();

        $request->coverPhoto->move(public_path('images/blogs'), $imageName);
    }

}
