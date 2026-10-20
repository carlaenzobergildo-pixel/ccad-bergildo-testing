<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PublisherController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('publisher/index', [
            'records' => Publisher::query()->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('publisher/create');
    }

    public function store(Request $request): RedirectResponse
    {
        Publisher::create($request->validate([
            'publisher_name' => ['required', 'string', 'max:255'],
        ]));

        return to_route('publishers.index');
    }

    public function edit(Publisher $publisher): Response
    {
        return Inertia::render('publisher/edit', ['record' => $publisher]);
    }

    public function update(Request $request, Publisher $publisher): RedirectResponse
    {
        $publisher->update($request->validate([
            'publisher_name' => ['required', 'string', 'max:255'],
        ]));

        return to_route('publishers.index');
    }

    public function destroy(Publisher $publisher): RedirectResponse
    {
        $publisher->delete();

        return to_route('publishers.index');
    }
}
