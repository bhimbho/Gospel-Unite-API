<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPasswordUpdateRequest;
use App\Http\Requests\Api\UserProfilePictureRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function picture_replace(UserProfilePictureRequest $request)
    {
        $user_details = $request->user();
        if(Storage::disk('s3')->exists($user_details->picture)){
            Storage::disk('s3')->delete($user_details->picture); //delete file
        }
        $user_details->picture = Storage::disk('s3')->put('user_profile_pictures', $request->picture, 'public');
        $user_details->update();
        return response()->json([
            'message' => 'Profile Picture has been updated',
        ], 201);
    }

    public function password_update(UserPasswordUpdateRequest $request)
    {
        $user_details = $request->user();
        $user_details->password = bcrypt($request->password);
        $user_details->update();
        // $request->user()->token()->revoke();
        // $user_details->tokens->each(function($token, $key) {
        //     $token->delete();
        // });
        return response()->json([
            'message' => 'Password has been updated',
        ], 201);
    }
    
    
    public function userProfile(Request $request) //remove $id for future reference user $request->
    {
        $user = User::with('tags')->find($request->user()->id);
        return response()->json([
            'user' => $user,
        ], 200);
    }

    public function getAnyUserProfile($id)
    {
          $user = User::find($id);
        return response()->json([
            'user' => $user
        ], 200);
    }


}
