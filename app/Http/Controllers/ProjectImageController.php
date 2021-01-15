<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectImageController extends Controller
{
    public function index(Project $project)
    {
        return Inertia::render('Admin/Views/AddImage', [
            'project' => $project,
        ]);
    }

    public function store(Request $request, Project $project)
    {
        $this->validate($request, [
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        foreach($request->images as $image) {

            dd($image);

//            $request->coverPhoto->move(public_path('images/blogs'), $imageName);

        }
    }
}
