<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show(User $user) 
    {
        $title = 'Profile';
        return view('users.profile', compact('user', 'title'));
    }

    public function update(Request $request, User $user) 
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:50',
            'email' => 'required|string|unique:users',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg,git|max:2048'
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('asset-images', 'public');
            }

            $user->update($request= [
                'name' => $request->name,
                'username' => $request->name,
                'email' => $request->email,  
                'image' => $imagePath,
            ]);
            return redirect()->route('posts.index')->with('success', 'Author Updated Successfully');
        } catch (\Throwable $err) {
            return redirect()->back()->withErrors(['error' => $err->getMessage()]);
        }
    }
}