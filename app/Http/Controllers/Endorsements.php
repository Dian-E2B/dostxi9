<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Yajra\DataTables\Facades\DataTables;
use Dompdf\Dompdf;
use Dompdf\Options;

class Endorsements extends Controller
{
    //
    public function endorsedongoing()
    {
        return view('endorsedongoing');
    }


    public function endorsedprogram(Request $request)
    {
        $year = $request->input('startyear');
        $semester = $request->input('semester');

        if (empty($year) && empty($semester)) {
            $endorsements = DB::table('ongoing_endorsed_view_reportings')
                ->select('*')
                ->where('startyear', now())
                ->take(50) // Limit to 50 records
                ->get();
        } elseif (isset($year) && isset($semester)) {
            $endorsements = DB::table('ongoing_endorsed')
                ->select('*')
                ->where('startyear', $year)
                ->where('semester', $semester)
                ->take(50) // Limit to 50 records
                ->get();
        } else {
            return response()->json(['error' => 'Both year and semester parameters are required.'], 400);
        }


        return DataTables::of($endorsements)->make(true);
    }



    public function endorsedongoingprint(Request $request, $year = null, $semester = null)
    {
        $endorsements = DB::table('ongoinglistendorseds')
            ->select('name', 'school', 'semester', 'year')
            ->where('year', $year)
            ->where('semester', $semester)
            ->groupBy('name', 'school', 'semester', 'year')
            ->orderBy('school')
            ->get();


        return view('endorsedongoingprint', compact('endorsements'));
    }
}
