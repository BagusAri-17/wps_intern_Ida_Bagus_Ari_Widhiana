<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DailyLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $level = $user->detail_user->position->level;
        $employeeTotal = User::get()->count();

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

        $logsToVerifyTotal = $logsToVerify->count();

        return view('pages.dashboard.index', compact('employeeTotal', 'logsToVerifyTotal', 'calendarEvents', 'level'));
    }
}
