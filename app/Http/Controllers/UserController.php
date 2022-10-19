<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User::withTrashed()->orderBy('id','DESC')->get();
            // $user_account_status = 1;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $actionBtn = '<a href="user/'.$data->id.'" class="edit btn btn-success btn-sm" ">View Activity</a>
                        <a href="user/'.$data->id.'/edit" class="edit btn btn-primary btn-sm" ">Update</a>
                        <button data-id="'.$data->id.'" id="suspend" class=" suspend btn btn-warning btn-sm">'.(($data->trashed())? 'Restore':'Suspend').'</button>
                        ';
                        return $actionBtn;
                    })
                    ->rawColumns(['action']) // returning action column
                    ->make(true);
        }
        return view('administrator.users.index')->with('users', User::all());
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
        return view('administrator.users.show')->with('users', User::withTrashed()->where('id',$id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('administrator.users.edit')->with('user', User::find($id)->first());
    }

    public function suspend($id)
    {
        $user = User::withTrashed()->where('id',$id)->first();
        if ($user->trashed()) {
            $user->restore();
            return response()->json("Account Restored",200);
        }
        $user->delete();
        return response()->json($user->trashed(),200);
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
    public function destroy(User $user)
    {
        // echo 1;
        $user->delete();
        return redirect()->back();
    }

    public function updatePhone($id, Request $request)
    {
        $user = User::find($id);
        $user->phone = $request->phone;
        $user->save();
        return redirect()->back();
    }
}
