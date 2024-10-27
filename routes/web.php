<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class,'home'])->name('posts.home');

/*
|--------------------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class,'showLogInForm'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::get('/register', [AuthController::class,'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class,'register']);
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

/*
|--------------------------------------------------------------------------------------
| Forgot Password Routes
|--------------------------------------------------------------------------------------
*/
Route::get('/password/reset', [ForgetPasswordController::class, 'showLinkRequest'])->name('password.request');
Route::post('/password/email', [ForgetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

/*
|--------------------------------------------------------------------------------------
| Reset Password Routes
|--------------------------------------------------------------------------------------
*/
Route::get('/password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class,'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------------------
    | User Profile Routes
    |--------------------------------------------------------------------------------------
    */
    Route::get('/profile/{user}', [UserProfileController::class,'show'])->name('profile');
    Route::put('/profile/update/{user}', [UserProfileController::class,'update'])->name('users.update');
    /*
    |--------------------------------------------------------------------------------------
    | Blog Routes
    |--------------------------------------------------------------------------------------
    */
    Route::get('/posts', [PostController::class,'index'])->name('posts.index');
    Route::get('/create-posts', [PostController::class,'create'])->name('posts.create');
    Route::post('/store-posts', [PostController::class,'store'])->name('posts.store');
    Route::get('/edit-posts/{post:slug}', [PostController::class,'edit'])->name('posts.edit');
    Route::put('/update-posts{post:slug}', [PostController::class,'update'])->name('posts.update');
    Route::delete('/delete-posts/{post:slug}', [PostController::class,'destroy'])->name('posts.destroy');
    Route::get('/posts/{post:slug}', function(Post $post){
        return view('blog.post', ['title' => 'Single Post', 'post' => $post]);
    });
    
    /*
    |--------------------------------------------------------------------------------------
    | Category Routes
    |--------------------------------------------------------------------------------------
    */
    Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit-category/{category:slug}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update-category/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/delete-category/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories/{category:slug}', function(Category $category){
        return view('blog.posts', ['title' => 'Articles of ' . $category->name, 'posts' => $category->posts]);
    });
    
    /*
    |--------------------------------------------------------------------------------------
    | Author Routes
    |--------------------------------------------------------------------------------------
    */
    Route::get('/authors', [AuthorController::class,'index'])->name('authors.index');
    Route::get('/create-authors', [AuthorController::class,'create'])->name('authors.create');
    Route::post('/store-authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('/edit-authors/{author}', [AuthorController::class,'edit'])->name('authors.edit');
    Route::put('/update-authors/{author}', [AuthorController::class,'update'])->name('authors.update');
    Route::delete('/delete-authors/{author}', [AuthorController::class,'destroy'])->name('authors.destroy');
    Route::get('/authors/{user:username}', function(User $user){
        return view('blog.posts', ['title' => count($user->posts) . ' Articles by ' . $user->name, 'posts' => $user->posts]);
    });
});