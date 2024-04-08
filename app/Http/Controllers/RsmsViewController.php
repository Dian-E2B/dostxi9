<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use App\Models\Cog;
use App\Models\Cogdetails;
use App\Models\Requestdocs;
use App\Models\Rsms_ra7687s;
use App\Models\Rsms_ra10612s;
use App\Models\Rsms_merits;
use App\Models\Rsms_noncompliance;
use App\Models\Sei;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Termwind\Components\Dd;

class RsmsViewController extends Controller //OR ONGOING
{
    //
    public function rsmsview()
    {

        $startyears = Ongoing::distinct()->pluck('startyear')->filter()->values();
        $endyears = Ongoing::distinct()->pluck('endyear')->filter()->values();
        $semesters = Ongoing::distinct()->pluck('semester')->filter()->values();

        // dd($startyears, $endyears, $semesters);

        return view('rsms', compact('startyears', 'endyears', 'semesters'));
    }




    //FILTERED OR IF VIEW IS CLICKED FROM ONGOING
    public function rsmsview2($startyear, $endyear, $semester)
    {


        // Session(['startyear' => $startyear, 'endyear' => $endyear, 'semester1' => $semester]);
        Session::put(['startyear' => $startyear, 'endyear' => $endyear, 'semester1' => $semester]);
        /*   dd($semester); */

        return view('rsms2', compact('startyear', 'endyear', 'semester'));
    }





    public function savechangesongongoing(Request $request, $number)
    {
        /*   $updatedData = $request->input('NAME'); */
        // Update the record using Eloquent ORM
        $ongoing = Ongoing::where('NUMBER', $number)->first();
        if ($ongoing) {
            $ongoingupdate =  $ongoing->update([
                'NAME' => $request->input('NAME'),
                'MF' => $request->input('MF'),
                'SCHOLARSHIPPROGRAM' => $request->input('SCHOLARSHIPPROGRAM'),
                'SCHOOL' => $request->input('SCHOOL'),
                'COURSE' => $request->input('COURSE'),
                'GRADES' => $request->input('GRADES'),
                'SummerREG' => $request->input('SummerREG'),
                'REGFORMS' => $request->input('REGFORMS'),
                'STATUSENDORSEMENT' => $request->input('STATUSENDORSEMENT'),
                'STATUSENDORSEMENT2' => $request->input('STATUSENDORSEMENT2'),
                'STATUS' => $request->input('STATUS'),
                'NOTATIONS' => $request->input('NOTATIONS'),
                'SUMMER' => $request->input('SUMMER'),
                'FARELEASEDTUITION' => $request->input('FARELEASEDTUITION'),
                'FARELEASEDTUITIONBOOKSTIPEND' => $request->input('FARELEASEDTUITIONBOOKSTIPEND'),
                'LVDCAccount' => $request->input('LVDCAccount'),
                'HVCNotes' => $request->input('HVCNotes'),
                'REMARKS' => $request->input('REMARKS'),
            ]);

            if ($ongoingupdate) {
                $ongoing = Ongoing::where('NUMBER', $number)->first();
            }
            /*     return response()->json(['result' =>   $updatedData]); */
            /*  if ($ongoingupdate) {
                return response()->json(['message' => 'Data updated successfully']);
            } else {
                return response()->json(['message' => 'Failed to update data'], 500);
            } */
            /* if ($ongoingupdate) {

                DB::table('ongoingremarks')->updateOrInsert(
                    ['scholar_id' => $number], // Update based on this condition
                    $request->only(['remarksDetails', 'semester', 'startyear', 'endyear'])
                );

                DB::table('ongoingregforms')->updateOrInsert(
                    ['scholar_id' => $number], // Update based on this condition
                    $request->only(['regformsDetails', 'semester', 'startyear', 'endyear'])
                );

                return response()->json(['message' => 'Changes saved successfully']);  // You can return a response if needed

            } else {
                return response()->json(['error' => 'Failed to save changes'], 500);
            } */
        } else {

            return response()->json(['error' =>  $number]);
        }
    }


    public function getOngoingById($number, $semester, $startyear)
    {
        $results = DB::select(
            "SELECT ongoing.*
        FROM ongoing
        WHERE ongoing.NUMBER = :number
        AND ongoing.semester = :semester
        AND ongoing.startyear = :startyear",
            ['number' => $number, 'semester' => $semester, 'startyear' => $startyear]
        );
        if (empty($results)) {
            return response()->json(['error' => 'Record not found'], 404);
        }
        return response()->json($results[0]);
    }



    public function viewscholarrecordsview($number)
    {
        $results = Cog::select('startyear', DB::raw('COUNT(*) as row_count'))
            ->where('scholar_id', $number)

            ->groupBy('startyear')
            ->get();
        // Convert the Eloquent collection to an array
        $resultArrayyear = $results->pluck('startyear')->toArray();
        $resultArray = [];
        foreach ($resultArrayyear as $year) {

            for ($semester = 1; $semester <= 3; $semester++) { // Fetching data for consecutive semesters with the same year
                $cogdata = Cog::with('cogdetails')
                    ->where('scholar_id', $number)
                    ->where('semester', $semester)
                    ->where('startyear', $year)
                    ->where('draft', '=', 0)
                    ->get();

                // Store the data for the semester in the result array
                $resultArray[$year][$semester] = $cogdata->toArray(); // Include all columns

            }
        }


        return view('viewscholarrecords', [
            'number' => $number,
            'resultArray' => $resultArray
        ]);
    }

    public function getscholargrades($number)
    {
        $cogdata = Cogdetails::find($number);


        if ($cogdata) {
            return response()->json($cogdata);
        }
    }

    public function getdocumentsdata($number)
    {
        $Requestdocs = Requestdocs::where('scholar_id', $number)->get();


        if ($Requestdocs) {
            return DataTables::of($Requestdocs)->make(true);
        }
    }

    public function viewdocument($number)
    {
        $Requestdocsview = Requestdocs::where('id', $number)->get();
        // return view('viewscholarprospectus', compact('prospectusdataview'));
        return view('viewdocument', ['Requestdocsview' => $Requestdocsview]);
    }

    public function getprospectusdata($number)
    {
        $prospectusdata = Cog::where('scholar_id', $number)->get();
        return DataTables::of($prospectusdata)->make(true);
    }

    public function viewscholarprospectus($number)
    {
        $prospectusdataview = Cog::where('id', $number)->get();
        // return view('viewscholarprospectus', compact('prospectusdataview'));
        return view('viewpropectus', ['prospectusdataview' => $prospectusdataview]);
    }

    public function officialrsms($number)
    {

        $seiresult = Sei::where('id', $number)->get();

        $results = Cog::select('startyear', DB::raw('COUNT(*) as row_count'))
            ->where('scholar_id', $number)
            ->groupBy('startyear')
            ->get();

        // Convert the Eloquent collection to an array
        $resultArrayyear = $results->pluck('startyear')->toArray();

        $resultArray = [];


        foreach ($resultArrayyear as $year) {
            // Fetching data for consecutive semesters with the same year
            for ($semester = 1; $semester <= 3; $semester++) {
                $cogdata = Cog::with('cogdetails')
                    ->where('scholar_id', $number)
                    ->where('semester', $semester)
                    ->where('startyear', $year)
                    ->get();
                //
                // Store the data for the semester in the result array
                $resultArray[$year][$semester] = $cogdata->toArray(); // Include all columns

            }
        }

        return view('officialrsms', [
            'number' => $number,
            'resultArray' => $resultArray,
            'seiresult' => $seiresult
        ]);
    }


    public function getscholarshipstatus($number)
    {
        $cogdata = Cog::find($number);

        if ($cogdata) {
            return response()->json($cogdata);
        }
    }

    public function savescholarshipstatus(Request $request, $number)
    {

        $cogdata = Cog::where('id', $number)->first();   // Find the record based on the given number

        if (!$cogdata) {
            return response()->json(['error' => 'Record not found'], 404);
        }
        $cogdata->update(['scholarshipstatus' => $request->input('scholarshipstatus')]);  // Update the record with the new data
        return response()->json(['message' => 'Changes saved successfully']);   // You can return a response if needed
    }

    public function savecholargrades(Request $request, $number)
    {
        $cogdata = Cogdetails::where('id', $number)->first(); // Find the record based on the given number

        if (!$cogdata) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        $cogdata->update($request->all()); // Update the record with the new data

        return response()->json(['message' => 'Changes saved successfully']);   // You can return a response if needed
    }


    public function completescholargrades($number)
    {
        $cogdata = Cogdetails::where('id', $number)->first(); // Find the record based on the given number


        if (!$cogdata) {
            return response()->json(['error' => 'Record not found'], 404);
        } else {
            $cogdata->update(['completed' => 1]);
        }

        // $cogdata->update($request->all()); // Update the record with the new data

        return response()->json(['message' => 'Records Completed successfully']);   // You can return a response if needed
    }










    public function saveOngoingById($number)
    {
        $ongoing = Ongoing::where('number', $number)->first();
        if (!$ongoing) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        return response()->json($ongoing);
    }






    public function rsmslistra7687view()
    {
        $rsmsra7687 = Rsms_ra7687s::all();
        return view('rsmslistra7687', compact('rsmsra7687'));
    }


    public function rsmslistra10612view()
    {
        $rsmsra10612 = Rsms_ra10612s::all();
        return view('rsmslistra10612', compact('rsmsra10612'));
    }

    public function rsmslistmeritview()
    {
        $rsmsmerit = Rsms_merits::all();
        return view('rsmslistmerit', compact('rsmsmerit'));
    }

    public function rsmslistnoncomplianceview()
    {
        $rsmsnoncompliance = Rsms_noncompliance::all();
        return view('rsmslistnoncompliance', compact('rsmsnoncompliance'));
    }
}
