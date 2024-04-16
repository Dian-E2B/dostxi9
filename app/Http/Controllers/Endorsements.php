<?php

namespace App\Http\Controllers;

use App\Models\Ongoinglist_endorsed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Yajra\DataTables\Facades\DataTables;

class Endorsements extends Controller
{
    //

    public function endorsedongoing(Request $request)
    {
        if ($request->ajax()) {
            $endorsements = Ongoinglist_endorsed::select('*');
            return DataTables::of($endorsements)
                ->addColumn('action', function ($endorsement) {
                    return '<a href="#" class="btn btn-sm btn-primary edit">Edit</a>';
                })
                ->rawColumns(['action']) // Make sure to specify that the 'action' column contains HTML
                ->make(true);
        }
        return view('endorsedongoing');
    }
}
