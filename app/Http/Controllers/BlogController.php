<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\TagCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = $request->user()->blogs()->get();
        return Inertia::render('Admin/Views/Blog', [
            'blogs' => $blogs,
        ]);
    }

    public function addBlog()
    {
        $tags = Tag::all();
        return Inertia::render('Admin/Views/AddBlog', [
            'tags' => $tags
        ]);
    }

    public function blogList()
    {
        $tags = Tag::all();
        foreach($tags as $key => $tag) {
            $tag->setAttribute('related', $tag->tagCollections);
        }
        $blogs = Blog::take(5)->latest()->get();
        foreach($blogs as $key => $blog) {
            $blog->setAttribute('tags', $blog->tagCollections);
        }
        return Inertia::render('BlogList/Index', [
            'blogs' => $blogs,
            'tags' => $tags
        ]);
    }

    public function viewBlog(Blog $blog)
    {
        $blogs = $blog->nextBlog();
        $tags = $blog->tagCollections;
        return Inertia::render('Blog/Index', [
            'blog' => $blog,
            'nextBlogs' => $blogs,
            'tags' => $tags
        ]);
    }

    public function updateBlog(Blog $blog)
    {
        $tags = $blog->tagCollections;
        return Inertia::render('Admin/Views/AddBlog', [
            'isUpdate' => true,
            'blog' => $blog,
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
        $request->validateWithBag('blogForm', [
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
            'coverPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->coverPhoto->extension();

        $request->coverPhoto->move(public_path('images/blogs'), $imageName);

        $blog = $request->user()->blogs()->create([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'image' => $imageName
        ]);

        foreach($request->tags as $key => $is_tag) {
            $tag = Tag::where('type', $is_tag)->first();
            TagCollection::create([
                'blog_id' => $blog->id,
                'tag_type' => $is_tag,
                'tag_id' => $tag->id,
            ]);
        }

        return redirect()->route('admin.blog')->with('message', 'Blog Successfully Added!');
    }

    public function destroy(Blog $blog)
    {
        $image_path = 'images/blogs/' . $blog->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        $blog->delete();

        return back();
    }

    public function update(Request $request)
    {
        $request->validateWithBag('blogForm', [
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
        ]);

        if($request->has('id')) {
            $request->user()->blogs()->find($request->id)->update($request->all());
            return redirect()->route('admin.blog');
        }

    }

}
