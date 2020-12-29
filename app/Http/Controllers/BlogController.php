<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = $request->user()->blogs()->get();
        return Inertia::render('Admin/Views/Blog', [
            'blogs' => $blogs
        ]);
    }

    public function addBlog()
    {
        return Inertia::render('Admin/Views/AddBlog');
    }

    public function viewBlog(Blog $blog)
    {
        return Inertia::render('Blog/Index', [
            'blog' => $blog
        ]);
    }

    public function updateBlog(Blog $blog)
    {
        return Inertia::render('Admin/Views/AddBlog', [
            'isUpdate' => true,
            'blog' => $blog
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

        $request->user()->blogs()->create([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'image' => $imageName
        ]);

        return redirect()->route('admin.blog');
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
