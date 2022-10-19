<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Song;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $books = Book::count();
        $songs = Song::count();
        $videos = Video::count();
        return view('home')->with(compact(['users', 'books', 'videos', 'songs']));
    }
}
