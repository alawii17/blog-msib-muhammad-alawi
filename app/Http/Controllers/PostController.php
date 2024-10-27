<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function home()
    {
        $posts = Post::all();
        $title = 'Welcome to MSIB BLOG';
        return view('home.index', compact('posts', 'title'));
    }

    public function index()
    {
        $posts = Post::all();
        $title = 'Posts';
        return view('blog.posts', compact('posts', 'title'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = User::all();
        $title = 'Add Blog';
        return view('blog.create', compact('categories', 'authors', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|unique:posts,slug',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg,gif|max:2048',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('asset-images', 'public');
            }

            Post::create([
                'title' => $request->title,
                'author_id' => $request->author_id,
                'category_id' => $request->category_id,
                'slug' => $request->slug,
                'body' => $request->body,
                'image' => $imagePath,
            ]);

            return redirect()->route('posts.index')->with('success', 'Blog Created Successfully');
        } catch (\Throwable $err) {
            return redirect()
                ->back()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $authors = User::all();
        $title = 'Edit Blog';
        return view('blog.edit', compact('categories','authors','title', 'post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|unique:posts,slug',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg,gif|max:2048',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('asset-images', 'public');
            }

            $post->update([
                'title' => $request->title,
                'author_id' => $request->author_id,
                'category_id' => $request->category_id,
                'slug' => $request->slug,
                'body' => $request->body,
                'image' => $imagePath,
            ]);

            return redirect()->route('posts.index')->with('success', 'Blog Updated Successfully');
        } catch (\Throwable $err) {
            return redirect()
                ->back()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Blog Deleted Successfully');
    }
}