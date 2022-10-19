<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/settings/2FA', [App\Http\Controllers\Auth2FAController::class, 'index'])->name('2FA');
Route::get('/settings/2FA/test', [App\Http\Controllers\Auth2FAController::class, 'test'])->name('2FA.test');

// Route::group(['middleware' => ['web']], function () {
    Route::post('user-password-reset', [App\Http\Controllers\api\AuthController::class, 'resetPassword'])->name('user.password.reset')->middleware('web');
    Route::get('user-password-reset/{token}/{email}', [App\Http\Controllers\api\AuthController::class, 'showResetForm'])->name('user.password.update');
// });

Route::get('/enable-2fa', [App\Http\Controllers\Auth2FAController::class, 'index'])->name('2FA');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('books', App\Http\Controllers\BookController::class);
    Route::put('book_cover_update/{id}', [App\Http\Controllers\BookController::class, 'cover_update']);

    // book chapter route
    Route::resource('books-chapters', App\Http\Controllers\BookChapterController::class);
    Route::get('books-chapters/all/{id}', [App\Http\Controllers\BookChapterController::class, 'all_chapters'])->name('books-chapters.all_chapters');


    Route::resource('videos', App\Http\Controllers\VideoController::class);
    Route::put('video_file_update/{id}', [App\Http\Controllers\VideoController::class, 'video_file_update']);
    Route::post('video_upload', [App\Http\Controllers\UploadController::class, 'store']);
    
    // Route::resource('sermon', App\Http\Controllers\SermonController::class);

    Route::resource('albums', App\Http\Controllers\AlbumController::class);
    Route::put('albums_cover_update/{id}', [App\Http\Controllers\AlbumController::class, 'cover_update']);
    
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::patch('user/update/phone/{id}', [App\Http\Controllers\UserController::class, 'updatePhone'])->name('user.phone.update');
    Route::resource('tags', App\Http\Controllers\TagsController::class);
    
    Route::resource('songs', App\Http\Controllers\SongsController::class);
    Route::put('song_file_update/{id}', [App\Http\Controllers\SongsController::class, 'song_file_update']);
    Route::post('song_upload', [App\Http\Controllers\UploadController::class, 'store_song']);

    Route::get('user_suspend/{id}', [App\Http\Controllers\UserController::class, 'suspend']);

    // Recently Joined Users
    Route::resource('recently-joined', App\Http\Controllers\RecentlyJoinedController::class);
    Route::get('recently-joined/{from}/{to}', [App\Http\Controllers\RecentlyJoinedController::class,'search_recently_joined_btw_dates'])->name('recently-joined.search');

    // Route::get('recently-joined/{from}/{to}', [App\Http\Controllers\RecentlyJoinedController::class,'search_recently_joined_btw_dates'])->name('recently-joined.search');

    Route::resource('push-notifications', App\Http\Controllers\PushNotificationController::class);

    Route::resource('admins', App\Http\Controllers\AdminController::class);
    Route::resource('privacypolicy', App\Http\Controllers\PrivacyPolicyController::class);
    Route::resource('termscondition', App\Http\Controllers\TermsConditionController::class);
});
