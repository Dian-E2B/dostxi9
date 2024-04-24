<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    //

    public function index()
    {
        return view('admin.dashboardadmin');
    }

    public function viewstaffs()
    {

        $users = User::where('role', 'staff')->get();
        return DataTables::of($users)
            ->addColumn('action', function ($user) {
                return '
                <button href="#" class="btn btn-sm btn-warning edit">Reset</button>
                <button href="#" class="btn btn-sm btn-danger edit">Delete</button>';
            })
            ->rawColumns(['action']) // Make sure to specify that the 'action' column contains HTML
            ->make(true);
    }
}
