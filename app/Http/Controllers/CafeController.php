<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\View\View;

class CafeController extends Controller
{
    /**
     * Display a listing of the cafes.
     */
    public function index(): View
    {
        $latestNews = \App\Models\Information::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();
        $cafes = Cafe::where('status', 'published')->with('facilities')->inRandomOrder()->get();

        return view('home', compact('cafes', 'latestNews'));
    }

    /**
     * Display the specified cafe.
     */
    public function show(Cafe $cafe): View
    {
        abort_if($cafe->status !== 'published', 404);

        $cafe->load(['menus', 'reviews', 'facilities']);

        return view('cafes.show', compact('cafe'));
    }

    public function energy(\Illuminate\Http\Request $request, Cafe $cafe)
    {
        $request->validate([
            'energy_count' => 'required|integer|min:1',
            'visitor_id' => 'required|string',
        ]);

        $reaction = \App\Models\CafeReaction::firstOrNew([
            'cafe_id' => $cafe->id,
            'visitor_id' => $request->visitor_id,
        ]);

        $reaction->energy_count += $request->energy_count;
        $reaction->save();

        $cafe->increment('total_energy', $request->energy_count);

        return response()->json([
            'success' => true,
            'new_total' => $cafe->total_energy,
        ]);
    }
}
