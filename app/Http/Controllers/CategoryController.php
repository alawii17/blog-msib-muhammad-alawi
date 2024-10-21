<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $title = 'All Categories';
        return view('categories.index', compact('categories', 'title'));
    }

    public function create()
    {
        return view('categories.create', ['title' => 'Add Category']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'required|string|unique:categories',
            'color' => 'required|string|unique:categories'
        ]);
        try {
            Category::create($request->all());
            return redirect()->route('categories.index')->with('success', 'Category Created Successfully');
        } catch (\Throwable $err) {
            return redirect()->route('categories.index')->with('error', $err->getMessage());
        }
    }

    public function edit(Category $category) 
    {
        $title = 'Edit Category';
        return view('categories.edit', compact('category', 'title'));
    }

    public function update(Request $request, Category $category) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'required|string|unique:categories',
            'color' => 'required|string|unique:categories' 
        ]);

        try {
            $category->update($request->all());
            return redirect()->route('categories.index')->with('success', 'Updated Successfully');
        } catch (\Throwable $err) {
            return redirect()->route('categories.index')->with('error', $err->getMessage());
        }
    }

    public function destroy(Category $category) 
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted Successfully');
    }
}