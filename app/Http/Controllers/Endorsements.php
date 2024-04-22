<?php

namespace App\Http\Controllers;

use App\Models\Ongoinglist_endorsed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Yajra\DataTables\Facades\DataTables;
use Dompdf\Dompdf;
use Dompdf\Options;

class Endorsements extends Controller
{
    //

    public function endorsedongoing(Request $request)
    {
        if ($request->ajax()) {
            $endorsements = Ongoinglist_endorsed::select('*');
            return DataTables::of($endorsements)
                /* ->addColumn('action', function ($endorsement) {
                    return '<button href="#" class="btn btn-sm btn-primary edit">Edit</button>';
                })
                ->rawColumns(['action']) // Make sure to specify that the 'action' column contains HTML */
                ->make(true);
        }
        return view('endorsedongoing');
    }

    public function endorsedongoingprint(Request $request, $year = null, $semester = null)
    {


        // Use provided $year and $semester in the query
        $endorsements = DB::table('ongoinglist_endorseds')
            ->select('name', 'school', 'semester', 'year')
            ->where('year', $year)
            ->where('semester', $semester)
            ->groupBy('name', 'school', 'semester', 'year')
            ->orderBy('school')
            ->get();


        return view('endorsedongoingprint', compact('endorsements'));
    }
}
