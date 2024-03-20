<?php

namespace App\Http\Controllers;

use App\Models\Notification_staffs;
use Illuminate\Http\Request;

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
}
