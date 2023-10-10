<?php

use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Http\Livewire\Home;
use App\Http\Livewire\Search;
use App\Http\Livewire\Explore;
use App\Models\NewNotification;

use App\Http\Livewire\CreatePost;
use App\Http\Livewire\EditProfile;
use App\Http\Livewire\MessageShow;
use App\Http\Livewire\DetailedPost;
use App\Http\Livewire\ExplorePosts;
use App\Http\Livewire\ExploreUsers;
use App\Http\Livewire\MessageIndex;
use App\Http\Livewire\ExplorePeople;
use App\Http\Livewire\Notifications;
use App\Http\Livewire\ShowCommunity;
use App\Http\Livewire\AboutCommunity;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CommunityCreate;
use App\Http\Livewire\ExploreCommunities;
use App\Http\Livewire\Profile\ProfileShow;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\EditCommunity;
use App\Http\Livewire\ManageMembers;
use App\Http\Livewire\ManagePosts;
use App\Http\Livewire\ModTools;
use App\Http\Livewire\PostEdit;
use App\Http\Livewire\PostReport;
use App\Http\Livewire\Report;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/home', Home::class)->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', EditProfile::class)->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{username}', ProfileShow::class)->name('profile.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/post/create/{community_id?}', CreatePost::class)->name('post.create');
    Route::get('/post/{post_id}/report', PostReport::class)->name('post.report');
    Route::get('/post/{post_id}/edit', PostEdit::class)->name('post.edit');
    Route::get('/post/{id}', DetailedPost::class)->name('post.show');
});

Route::middleware('auth')->group(function (){
    Route::get('/explore', Explore::class)->name('explore');
    Route::get('/explore/users', ExploreUsers::class)->name('explore.users');
    Route::get('/explore/posts', ExplorePosts::class)->name('explore.posts');
    Route::get('/explore/communities', ExploreCommunities::class)->name('explore.communities');
});


Route::middleware('auth')->group(function () {
    Route::get('/community/create', CommunityCreate::class)->name('community.create');
    Route::get('/community/{handle_name}', ShowCommunity::class)->name('community.show');
    Route::get('/community/{handle_name}/about', AboutCommunity::class)->name('community.about');
    Route::get('/community/{handle_name}/edit', EditCommunity::class)->name('community.edit');
    Route::get('/community/{handle_name}/posts/tools', ManagePosts::class)->name('community.modPosts');
    Route::get('/community/{handle_name}/members/tools', ManageMembers::class)->name('community.modMembers');
    
});



Route::middleware('auth')->group(function () {
    
    Route::get('/messages', MessageIndex::class)->name('messages.index');
    Route::get('/messages/{username}', MessageShow::class)->name('messages.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/notification', Notifications::class)->name('notifications');
});

require __DIR__.'/auth.php';
