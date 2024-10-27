<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        $title = 'All Authors';
        return view('authors.index', compact('authors', 'title'));
    }

    public function create()
    {
        return view('authors.create', ['title' => 'Add Author']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|unique:authors',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg,git|max:2048'
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('asset-images', 'public');
            }

            Author::create([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $imagePath,
            ]);
            return redirect()->route('authors.index')->with('success', 'Author Created Successfully');
        } catch (\Throwable $err) {
            return redirect()->back()->withErrors(['error' => $err->getMessage()]);
        }
    }

    public function edit(Author $author) 
    {
        $title = 'Edit Author';
        return view('authors.edit', compact('author', 'title'));
    }

    public function show(Author $auhtor) 
    {
        return view('authors.show', compact('author'));
    }

    public function update(Request $request, Author $author) 
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|unique:authors',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg,git|max:2048'
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('asset-images', 'public');
            }

            $author->update($request= [
                'name' => $request->name,
                'email' => $request->email,  
                'image' => $imagePath,
            ]);
            return redirect()->route('authors.index')->with('success', 'Author Updated Successfully');
        } catch (\Throwable $err) {
            return redirect()->back()->withErrors(['error' => $err->getMessage()]);
        }
    }

    public function destroy(Author $author) 
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted Successfully');
    }
}