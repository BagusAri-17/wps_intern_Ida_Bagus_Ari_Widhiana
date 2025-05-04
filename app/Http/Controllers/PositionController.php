<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::where('level', '!=', 1)->get();

        return view('pages.dashboard.manage-position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.manage-position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
        ]);

        Position::create([
            'name' => $request->name,
            'level' => intval($request->level),
            'created_by' => Auth::user()->id
        ]);

        return Redirect::route('manage-position.index');
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
        $position = Position::findOrFail($id);

        return view('pages.dashboard.manage-position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
        ]);

        $position = Position::findOrFail($id);

        $data = [
            'name' => $request->name,
            'level' => intval($request->level),
            'created_by' => Auth::user()->id
        ];

        $position->update($data);

        return Redirect::route('manage-position.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Position::findOrFail($id);

        $position->delete();

        return Redirect::route('manage-position.index');
    }
}
