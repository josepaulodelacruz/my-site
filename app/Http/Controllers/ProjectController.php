<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTags;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        foreach ($projects as $key => $project) {
            $project->setAttribute('tags', $project->projectTags);
        }

        return Inertia::render('Admin/Views/Projects', [
            'projects' => $projects,
        ]);
    }

    public function addProjects()
    {
        $tags = Tag::all();
        return Inertia::render('Admin/Views/AddProjects', [
            'tags' => $tags
        ]);
    }

    public function updateProject(Project $project)
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

        $project = $request->user()->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
            'created' => $request->created,
            'website' => $request->website,
            'repository' => $request->repository,
        ]);

        foreach($request->tags as $key => $is_tag) {
            $tag = Tag::where('type', $is_tag)->first();
            ProjectTags::create([
                'project_id' => $project->id,
                'tag_type' => $is_tag,
                'tag_id' => $tag->id,
            ]);
        }

        return redirect()->route('admin.projects')->with('message', 'Successfully added Projrect');

    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('message', 'Successfully Deleted');
    }


}
