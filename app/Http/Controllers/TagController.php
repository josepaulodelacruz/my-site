<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index ()
    {
        $tags = Tag::all();
        foreach($tags as $key => $tag) {
            $tag->setAttribute('related', $tag->tagCollections->count());
        }
        return Inertia::render('Admin/Views/Tags', [
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
        $request->validateWithBag('tagForm', [
            'type' => 'required|max:20|unique:tags',
        ]);

        Tag::create([
           'type' => $request->type,
        ]);

        return redirect()->back()
            ->with('message', 'Tags Created Successfully');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->back()
            ->with('message', 'Tag Successfully Deleted');

    }
}
