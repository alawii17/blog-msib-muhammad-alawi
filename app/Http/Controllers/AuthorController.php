<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::all();
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
            'username' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg,git|max:2048'
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('asset-images', 'public');
            }

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),  
                'image' => $imagePath,
            ]);
            return redirect()->route('authors.index')->with('success', 'Author Created Successfully');
        } catch (\Throwable $err) {
            return redirect()->back()->withErrors(['error' => $err->getMessage()]);
        }
    }

    public function edit(User $author) 
    {
        $title = 'Edit Author';
        return view('authors.edit', compact('author', 'title'));
    }

    public function show(User $auhtor) 
    {
        return view('authors.show', compact('author'));
    }

    public function update(Request $request, User $author) 
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg,git|max:2048'
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('asset-images', 'public');
            }

            $author->update($request= [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),  
                'image' => $imagePath,
            ]);
            return redirect()->route('authors.index')->with('success', 'Author Updated Successfully');
        } catch (\Throwable $err) {
            return redirect()->back()->withErrors(['error' => $err->getMessage()]);
        }
    }

    public function destroy(User $author) 
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted Successfully');
    }
}