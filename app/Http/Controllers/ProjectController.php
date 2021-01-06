<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Views/Projects');
    }

    public function addProjects()
    {
        $tags = Tag::all();
        return Inertia::render('Admin/Views/AddProjects', [
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
        $request->validateWithBag('projectForm', [
           'title' => 'required',
           'description' => "required|max:255",
           'created' => 'required',
           'website' => 'required',
           'repository' => 'required',
        ]);


        $request->user()->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
            'created' => $request->created,
            'website' => $request->website,
            'repository' => $request->repository,
        ]);

        return redirect()->route('admin.projects')->with('message', 'Successfully added Projrect');

    }
}
