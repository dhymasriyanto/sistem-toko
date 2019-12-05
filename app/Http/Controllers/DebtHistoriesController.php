<?php

namespace App\Http\Controllers;

use App\DebtHistory;
use Illuminate\Http\Request;

class DebtHistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('debt-histories.index');

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
     * @param  \App\DebtHistory  $debtHistory
     * @return \Illuminate\Http\Response
     */
    public function show(DebtHistory $debtHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DebtHistory  $debtHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtHistory $debtHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DebtHistory  $debtHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DebtHistory $debtHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DebtHistory  $debtHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtHistory $debtHistory)
    {
        //
    }
}
