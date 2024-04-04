<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OngoingController extends Controller
{
    //ONGOING SECTION


    public function getOngoingData(Request $request)
    {
        $currentYear = Carbon::now()->year - 1;
        $ongoing = Ongoing::select('*')->where('startyear', $currentYear)->get();
        return DataTables::of($ongoing)->make(true);
    }

    public function getOngoingDataFiltered(Request $request)
    {

        $startyear = session('startyear');
        $endyear = session('endyear');
        $semester = session('semester');
        $currentYear = Carbon::now()->year - 1;
        $ongoing = Ongoing::select('*')
            ->where('startyear', $startyear)
            ->where('endyear', $endyear)
            ->where('semester', $semester)
            ->get();

        return DataTables::of($ongoing)->make(true);
    }


    public function getongoinglistgroupsajax(Request $request)
    {
        $results = DB::select("SELECT * FROM ongoing_monitoring ORDER BY startyear DESC, semester ASC;");
        return DataTables::of($results)->make(true);
    }

    //RETRIEVE DATA ON RSMS2 PAGE
    public function getongoinglistgroupsajaxviewclicked(Request $request)

    {
        $startyear = $request->input('startyear');
        $endyear = $request->input('endyear');
        $semester = $request->input('semester');

        /*   dd($startyear, $endyear, $semester1); */

        $results = DB::select(
            "SELECT * FROM ongoing
        WHERE ongoing.startyear = ?
        AND ongoing.endyear = ?
        AND ongoing.semester = ?", // Change $semester1 to $semester
            [$startyear, $endyear, $semester]
        );

        return DataTables::of($results)->make(true);
    }

    public function ongoinglist(Request $request)
    {
        $resultsongoinglist = DB::select("SELECT * FROM ongoing_monitoring ORDER BY startyear DESC, semester ASC;");
        return view('ongoinglists', [
            'results' => $resultsongoinglist,
        ]);
    }
}
