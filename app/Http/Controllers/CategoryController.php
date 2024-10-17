<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', //validation
            'description' => 'nullable|string',
        ]);
        try {
            Category::create($request->all());
            return redirect()->route('categories.index')->with('success', 'Category Created Successfully');
        } catch (\Throwable $err) {
            return redirect()->route('categories.index')->with('error', $err->getMessage());
        }
    }
}