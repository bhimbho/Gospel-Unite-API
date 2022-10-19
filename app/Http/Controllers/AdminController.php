<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminRequests;
use App\Http\Requests\Admin\AdminUpdateRequests;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Admin::orderBy('id','desc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('action', function($data){
                        $actionBtn = '<a data-id="'.$data->id.'" class="edit btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Edit</a>
                        <button type="button" id="" data-id="'.$data->id.'" class="form_delete delete btn btn-danger btn-sm">Delete</button>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action']) // returning action column
                    ->make(true);
        }
        return view('administrator.admins.index');
        // return view('administrator.admins.index');
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
    public function store(AdminRequests $request)
    {
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'roles' => $request->roles,
            'password' => bcrypt('gospelunitednewbie')
        ]);
        return response()->json('Administrator Added', 201);
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
        $admin = Admin::find($id);
        return response()->json($admin,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequests $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->roles = $request->role;
        $admin->password = isset($request->password)? bcrypt($request->password) : $admin->password;
        $admin->save();
        return response()->json('Update Successful', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Admin::find($id);
        $album->delete();

        return response()->json('Admin Delete Successfully', 200);
    }
}
