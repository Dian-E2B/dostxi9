<?php

namespace App\Http\Controllers;

use App\Models\Notification_staffs;
use App\Models\Notification_schols;
use Illuminate\Http\Request;
use App\Notifications\RandomNotification;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class HeaderController extends Controller
{
    //
    public function notificationsstaff()
    {
        $count = Notification_staffs::count();
        return response()->json(['count' => $count]);
    }

    public function notificationsgetall()
    {
        $notifications = Notification_staffs::all();
        return response()->json(['notifications' => $notifications]);
    }

    public function notificationsgetspecific()
    {
        $notificationsscholars = Notification_schols::where('scholar_id', Auth::user()->scholar_id)->get();
        return response()->json(['notificationsscholars' => $notificationsscholars]);
    }


    public function notificationsscholarcount()
    {
        $count = Notification_schols::groupBy('scholar_id')->count();
        return response()->json(['count' => $count]);
    }

    public function studentnotificationclear($data_id)
    {
        $thesisnotif = Notification_schols::where('data_id', $data_id)->first();
        if ($thesisnotif->type == "Thesis" || $thesisnotif->type == "Final Manuscript") {
            Notification_schols::where('data_id', $data_id)->delete();
            return redirect()->route('student/thesis');
        } elseif ($thesisnotif->type == "First Requirements") {
            Notification_schols::where('data_id', $data_id)->delete();
            return redirect()->route('student/gradeinput');
        } else {
            Notification_schols::where('data_id', $data_id)->delete();
            return redirect()->route('student/gradeinput');
        }
    }
}
