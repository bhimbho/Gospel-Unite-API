<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function privacypolicy(){
        $policy =  PrivacyPolicy::firstOrFail();
        return response()->json([
            'message' => $policy->privacy_policy,
            'status' => 201
        ]);
    }
}
