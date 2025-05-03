<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = collect();

        if (Auth::user()->detail_user->position->level === 1) {
            $users = User::whereHas('detail_user', function ($q) {
                $q->whereIn('position_id', function ($sub) {
                    $sub->select('id')->from('positions')->where('level', '>', 1);
                });
            })->get();
        }

        if (Auth::user()->detail_user->position->level === 2) {
            $users = User::whereHas('detail_user', function ($q) {
                $q->whereIn('position_id', function ($sub) {
                    $sub->select('id')->from('positions')->where('level', '=', 3);
                })->where('manage_by', Auth::user()->id);
            })->get();
        }

        return view('pages.dashboard.manage-user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::where('level', '!=', 1)->where('level', '!=', value: 2)->get();

        $manage_by = Position::where('level', '!=', 1)->where('level', '!=', value: 3)->get();

        return view('pages.dashboard.manage-user.create', compact('positions', 'manage_by'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        DetailUser::create([
            'user_id' => $user->id,
            'position_id' => $request->position_id,
            'manage_by' => $request->manage_by,
        ]);

        return Redirect::route('manage-user.index');
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
        $user = User::findOrFail($id);

        $positions = Position::where('level', '!=', 1)->where('level', '!=', value: 2)->get();

        $manage_by = Position::where('level', '!=', 1)->where('level', '!=', value: 3)->get();

        return view('pages.dashboard.manage-user.edit', compact('user', 'positions', 'manage_by'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::findOrFail($id);
        $detail = DetailUser::where('user_id', $id)->firstOrFail();

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user->update($userData);

        $detail->update([
            'position_id' => $request->position_id,
            'manage_by' => $request->manage_by,
        ]);

        return Redirect::route('manage-user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return Redirect::route('manage-user.index');
    }
}
