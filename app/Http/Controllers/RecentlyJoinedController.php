<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RecentlyJoinedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $user_joined_in_7days = User::whereDate('created_at','>=', Carbon::now()->subDays(7))->orderBy('created_at','DESC')->get();
            if($request->ajax()){
                $data = $user_joined_in_7days;
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->make(true);
            }
            return view('administrator.user-activity.recently-joined');
    }

    /**
     * Display the specified resource between a ranged date.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search_recently_joined_btw_dates(Request $request,$from,$to)
    {
        $to = ($to)? $to: Carbon::today();
        // $from = $from->toDateTimeString();
        $user_joined_wtn_days = User::whereDate('created_at','>=', $from, 'AND', 'created_at','<=', $to);
            if($request->ajax()){
                $data = $user_joined_wtn_days;
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->make(true);
            }
            // return view('administrator.user-activity.recently-joined');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
