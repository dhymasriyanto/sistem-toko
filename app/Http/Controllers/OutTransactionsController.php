<?php

namespace App\Http\Controllers;

use App\OutTransaction;
use Illuminate\Http\Request;

class OutTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('out-transactions.index');
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
     * @param  \App\OutTransaction  $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(OutTransaction $outTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OutTransaction  $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(OutTransaction $outTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OutTransaction  $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutTransaction $outTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OutTransaction  $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutTransaction $outTransaction)
    {
        //
    }
}
