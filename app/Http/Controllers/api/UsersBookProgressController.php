<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UsersBookProgress;
use Illuminate\Http\Request;

class UsersBookProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $chapter_id)
    {
        $this->validate($request, [
            'position' => 'required|integer',
            'progress' => 'required|integer',
            'book_id' => 'required|integer'
        ]);
        $lig = UsersBookProgress::updateOrCreate(
            [ 'chapter_id' => $chapter_id],
            ['progress' => $request->progress, 'current_chapter_position' => $request->position, 'book_id' => $request->book_id, 'user_id' => $request->user()->id]
        );
        return response()->json(['status' => 201]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsersBookProgress  $usersBookProgress
     * @return \Illuminate\Http\Response
     */
    public function show(UsersBookProgress $usersBookProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsersBookProgress  $usersBookProgress
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersBookProgress $usersBookProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsersBookProgress  $usersBookProgress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsersBookProgress $usersBookProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsersBookProgress  $usersBookProgress
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersBookProgress $usersBookProgress)
    {
        //
    }
}
