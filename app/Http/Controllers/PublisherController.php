<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Publisher;
use App\Services\PublisherService;
use Illuminate\Http\Request;
use Inertia\Response;

class PublisherController extends Controller
{
    

    public function __construct(
        private readonly PublisherService $publisherservice
    ){}    

    public function index(Request $req): Response
    {
        $search = $req->search;
        $publishers = $this->publisherservice->paginate(
            is_string($search) ? $search : null , 10
        );

        return Inertia::render('publisher\index',[
            'publisher' => $publishers,
            'filters' => [
                'search' => is_string($search) ? $search : '',
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('publish\create');
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
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        //
    }
}
