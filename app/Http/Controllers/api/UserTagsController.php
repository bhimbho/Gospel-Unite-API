<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserTagsRequest;
use App\Models\TagUsers;
use Illuminate\Http\Request;

class UserTagsController extends Controller
{

    public function store(UserTagsRequest $request)
    {
        $model =$request->user();
        $model->tags()->attach($request->tags);
        return response()->json([
            'Message' => 'Choice has been saved',
        ], 201);
    }

    
}
