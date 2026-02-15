<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrialController extends BasePageController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentLangData = $this->getCurrentLanguageData();

        return view('landing_page.form.trial', compact('currentLangData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
