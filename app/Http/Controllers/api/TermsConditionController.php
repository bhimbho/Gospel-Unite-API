<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\TermsCondition;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function termscondition(){
        $terms =  TermsCondition::first();
        return response()->json([
            'message' => $terms->terms_and_condition,
            'status' => 201
        ]);
    }
}
