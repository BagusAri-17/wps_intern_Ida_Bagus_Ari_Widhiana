<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class DailyLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $level = $user->detail_user->position->level;

        $myLogs = DailyLog::where('user_id', $user->id)->get();
        $listLogs = collect();
        $logsToVerify = collect();

        if ($level === 1) {
            $verifyIds = User::whereHas('detail_user', function ($q) {
                $q->whereIn('position_id', function ($sub) {
                    $sub->select('id')->from('positions')->where('level', '>', 1);
                });
            })->pluck('id');

            $listLogs = DailyLog::whereIn('user_id', $verifyIds)->get();
            $logsToVerify = DailyLog::whereIn('user_id', $verifyIds)->where('status', 'pending')->get();
        } elseif ($level === 2) {
            $verifyIds = User::whereHas('detail_user', function ($q) {
                $q->whereIn('position_id', function ($sub) {
                    $sub->select('id')->from('positions')->where('level', '=', 3);
                })->where('manage_by', Auth::user()->id);
            })->pluck('id');

            $listLogs = DailyLog::whereIn('user_id', $verifyIds)->get();
            $logsToVerify = DailyLog::whereIn('user_id', $verifyIds)->where('status', 'pending')->get();
        }

        $calendarEvents = $listLogs->map(function ($item) {
            return [
                'title' => Str::limit($item->description, 20),
                'start' => $item->created_at->format('Y-m-d'),
                'url' => route('manage-daily-log.show', $item->id),
            ];
        });

        return view('pages.dashboard.manage-daily-log.index', compact('level', 'myLogs', 'logsToVerify', 'listLogs', 'calendarEvents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.manage-daily-log.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $level = $user->detail_user->position->level;
        $timestamp = now()->format('Ymd_His');

        $fileProofOfEmployment = $request->file('proof_of_employment');
        $customFileProofOfEmploymentName = 'FileProofOfEmployment_'.$timestamp.'_UID'.$userId.'_L'.$level.'.'.$fileProofOfEmployment->extension();

        $request->validate([
            'description' => 'required|string',
            'proof_of_employment' => 'max:2048'
        ]);

        DailyLog::create([
            'user_id' => $userId,
            'description' => $request->description,
            'proof_of_employment' => $fileProofOfEmployment->storeAs('file-proof-of-employment', $customFileProofOfEmploymentName, 'public'),
            'status' => 'pending'
        ]);

        return Redirect::route('manage-daily-log.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dailyLog = DailyLog::findOrFail($id);

        return view('pages.dashboard.manage-daily-log.detail', compact('dailyLog'));
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

    public function accepted($id)
    {
        $dailyLog = DailyLog::find($id);
        $dailyLog->status = 'accept';
        
        $dailyLog->save();
        return Redirect::route('manage-daily-log.index');
    }

    public function rejected($id)
    {
        $dailyLog = DailyLog::find($id);
        $dailyLog->status = 'reject';
        
        $dailyLog->save();
        return Redirect::route('manage-daily-log.index');
    }
}
