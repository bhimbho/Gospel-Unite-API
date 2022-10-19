<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {

        Route::post('login', [App\Http\Controllers\api\AuthController::class, 'login']);
        Route::post('register', [App\Http\Controllers\api\AuthController::class, 'register']);
        Route::post('forgot-password', [App\Http\Controllers\api\AuthController::class, 'forgot']);
        Route::post('confirm-user', [App\Http\Controllers\api\AuthController::class, 'confirmAuthCode']);

        Route::post('confirm-user-password-reset', [App\Http\Controllers\api\AuthController::class, 'confirmUserForPasswordReset']);
        Route::post('reset-unsignin-password', [App\Http\Controllers\api\AuthController::class, 'resetPasswordWithoutToken']);

        Route::middleware(['auth:api'])->group(function () {
            // all users
            // Route::get('all', [App\Http\Controllers\api\AllUserController::class, 'index']);
            Route::resource('user_tags', App\Http\Controllers\api\UserTagsController::class);
            Route::get('user', [App\Http\Controllers\api\UserController::class, 'userProfile']);
            Route::get('user-profile/{id}', [App\Http\Controllers\api\UserController::class, 'getAnyUserProfile']);

            // Books
            Route::resource('books', App\Http\Controllers\api\BooksController::class);
            Route::get('books-recommend', [App\Http\Controllers\api\BooksController::class, 'recommendBooks']);

            // Book Chapters
            Route::get('all-book-chapters/{book_id}', [App\Http\Controllers\api\BooksChapterController::class, 'index']);
            Route::get('book-chapters/{chapter_id}', [App\Http\Controllers\api\BooksChapterController::class, 'show']);

            Route::post('book-chapters-progress/{chapter_id}', [App\Http\Controllers\api\UsersBookProgressController::class, 'store']);

            // Book Category
            Route::get('book-category', [App\Http\Controllers\api\BooksCategoryController::class, 'index']);
            Route::get('book-category/{book_category}', [App\Http\Controllers\api\BooksCategoryController::class, 'show']);

            // Songs
            Route::resource('songs', App\Http\Controllers\api\SongsController::class);
            Route::resource('song-category', App\Http\Controllers\api\SongsCategoryController::class);

            // Videos
            Route::resource('videos', App\Http\Controllers\api\VideosController::class);
            Route::resource('video-category', App\Http\Controllers\api\VideosCategoryController::class);
            Route::post('comment/{video_id}', [App\Http\Controllers\api\VideoCharacteristicsController::class, 'storeComment']);
            Route::post('like/{video_id}', [App\Http\Controllers\api\VideoCharacteristicsController::class, 'storeLikes']);

            //tags
            Route::get('tags', [App\Http\Controllers\api\TagsController::class, 'index']);

            //User Account Management Section
            Route::post('picture_replace', [App\Http\Controllers\api\UserController::class, 'picture_replace']);
            Route::post('password_update', [App\Http\Controllers\api\UserController::class, 'password_update']);
            Route::post('logout', [App\Http\Controllers\api\AuthController::class, 'logout']);
            Route::get('search', [App\Http\Controllers\api\SearchController::class, 'search_all_media']);
            Route::get('user-library-search', [App\Http\Controllers\api\SearchController::class, 'user_library_search']);

            Route::post('book-bookmark', [App\Http\Controllers\api\BooksBookmarkController::class, 'store']);
            Route::get('top-book', [App\Http\Controllers\api\TopRatedController::class, 'topBook']);
            Route::post('book-stream', [App\Http\Controllers\api\BookStreamController::class, 'store']);
            Route::get('book-stream', [App\Http\Controllers\api\BookStreamController::class, 'recentlyPlayed']);
            Route::get('recommended-books/', [App\Http\Controllers\api\BookStreamController::class, 'recommendedBooks']);
            Route::get('book-views/{book_id}', [App\Http\Controllers\api\BookStreamController::class, 'BookViews']);

            Route::post('song-bookmark', [App\Http\Controllers\api\SongsBookmarkController::class, 'store']);
            Route::get('top-song', [App\Http\Controllers\api\TopRatedController::class, 'topSong']);
            Route::post('song-stream', [App\Http\Controllers\api\SongStreamController::class, 'store']);
            Route::get('song-stream', [App\Http\Controllers\api\SongStreamController::class, 'recentlyPlayed']);
            Route::get('recommended-songs/', [App\Http\Controllers\api\SongStreamController::class, 'recommendedSongs']);
            Route::get('song-views/{song_id}', [App\Http\Controllers\api\SongStreamController::class, 'SongViews']);

            Route::post('video-bookmark', [App\Http\Controllers\api\VideosBookmarkController::class, 'store']);
            Route::get('top-video', [App\Http\Controllers\api\TopRatedController::class, 'topVideo']);
            Route::get('all-top-rated', [App\Http\Controllers\api\TopRatedController::class, 'allTopMedia']);
            Route::get('similar-videos/', [App\Http\Controllers\api\VideoCharacteristicsController::class, 'similarVideos']);

            Route::post('video-stream', [App\Http\Controllers\api\VideoStreamController::class, 'store']);
            Route::get('video-stream', [App\Http\Controllers\api\VideoStreamController::class, 'recentlyPlayed']);
            Route::get('recommended-videos', [App\Http\Controllers\api\VideoStreamController::class, 'recommendedVideos']);
            Route::get('video-views/{video_id}', [App\Http\Controllers\api\VideoStreamController::class, 'VideoViews']);




        });

        Route::get('privacy-policy', [App\Http\Controllers\api\PrivacyPolicyController::class, 'privacypolicy']);
        Route::get('terms-condition', [App\Http\Controllers\api\TermsConditionController::class, 'termscondition']);

});

