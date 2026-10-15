<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\AuthorProfile;

class AuthorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authorProfiles = AuthorProfile::select(['id', 'author_id', 'bio'])->with([
            'author:id,publisher_id,name',
        ])->get();

        dd($authorProfiles);

        return Inertia::render('author-profile/index', [
            'authorProfiles' => $authorProfiles
        ]);
        //
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
    public function show(AuthorProfile $authorProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuthorProfile $authorProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AuthorProfile $authorProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuthorProfile $authorProfile)
    {
        //
    }
}
