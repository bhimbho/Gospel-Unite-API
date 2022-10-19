<?php

namespace App\Http\Controllers;

use App\Http\Requests\TermsCondition\TermsConditionRequest;
use App\Models\TermsCondition;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.termscondition.index')->with('termscondition', TermsCondition::first());
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
    public function store(TermsConditionRequest $request)
    {
        TermsCondition::updateOrCreate(
            ['id' => 1],
            ['terms_and_condition' => $request->terms]
        ) ;
//        return response()->json('Terms and Condition Updated', 201);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermsCondition  $termsCondition
     * @return \Illuminate\Http\Response
     */
    public function show(TermsCondition $termsCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermsCondition  $termsCondition
     * @return \Illuminate\Http\Response
     */
    public function edit(TermsCondition $termsCondition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermsCondition  $termsCondition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermsCondition $termsCondition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermsCondition  $termsCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermsCondition $termsCondition)
    {
        //
    }
}
