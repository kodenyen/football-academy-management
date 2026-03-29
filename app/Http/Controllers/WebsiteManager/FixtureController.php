<?php

namespace App\Http\Controllers\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\MatchFixture;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index()
    {
        $fixtures = MatchFixture::orderBy('match_date', 'desc')->paginate(10);
        return view('website_manager.fixtures.index', compact('fixtures'));
    }

    public function create()
    {
        return view('website_manager.fixtures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'opponent' => 'required|string|max:255',
            'team_category' => 'required|string',
            'match_date' => 'required|date',
            'venue' => 'required|string',
            'status' => 'required|string',
        ]);

        MatchFixture::create($request->all());

        return redirect()->route('website.fixtures.index')->with('success', 'Fixture added successfully!');
    }

    public function edit(MatchFixture $fixture)
    {
        return view('website_manager.fixtures.edit', compact('fixture'));
    }

    public function update(Request $request, MatchFixture $fixture)
    {
        $request->validate([
            'opponent' => 'required|string|max:255',
            'team_category' => 'required|string',
            'match_date' => 'required|date',
            'venue' => 'required|string',
            'status' => 'required|string',
            'our_score' => 'nullable|integer',
            'opponent_score' => 'nullable|integer',
        ]);

        $fixture->update($request->all());

        return redirect()->route('website.fixtures.index')->with('success', 'Fixture updated successfully!');
    }

    public function destroy(MatchFixture $fixture)
    {
        $fixture->delete();
        return redirect()->route('website.fixtures.index')->with('success', 'Fixture deleted!');
    }
}
