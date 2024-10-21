<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class,'index'])->name('posts.index');
Route::get('/posts', [PostController::class,'index'])->name('posts.index');
Route::get('/create-posts', [PostController::class,'create'])->name('posts.create');
Route::post('/store-posts', [PostController::class,'store'])->name('posts.store');

// Route::get('/', function () {
//     return view('blog.posts', ['title' => 'Welcome to MSIB Blog', 'posts' => Post::filter(request(['search', 'category']))->latest()->get()]);
// });

// Route::get('/posts', function () {
//     return view('blog.posts', ['title' => 'Welcome to MSIB Blog', 'posts' => Post::filter(request(['search', 'category']))->latest()->get()]);
// });

Route::get('/posts/{post:slug}', function(Post $post){
    return view('blog.post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function(User $user){
    return view('blog.posts', ['title' => count($user->posts) . ' Articles by ' . $user->name, 'posts' => $user->posts]);
});

Route::get('/categories/{category:slug}', function(Category $category){
    return view('blog.posts', ['title' => 'Articles of ' . $category->name, 'posts' => $category->posts]);
})->where('category', '[a-z0-9-]+');

Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');
Route::get('/add-category', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/store-category', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/edit-category/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/update-category/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/delete-category/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/authors', [AuthorController::class,'index'])->name('authors.index');
Route::get('/create-authors', [AuthorController::class,'create'])->name('authors.create');
Route::post('/store-authors', [AuthorController::class, 'store'])->name('authors.store');
Route::get('/edit-authors/{author}', [AuthorController::class,'edit'])->name('authors.edit');
Route::put('/update-authors/{author}', [AuthorController::class,'update'])->name('authors.update');
Route::delete('/delete-authors/{author}', [AuthorController::class,'destroy'])->name('authors.destroy');

// Route::get('/auhtors', function () {
//     return view('auhtor', ['title' => 'Auhtors']);
// });