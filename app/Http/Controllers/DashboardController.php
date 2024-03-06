<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboardview(Request $request)
    {
        if (empty($startYear) && empty($endYear)) {
            $startYear = $request->input('startyear');
            /* ScholarshipProgram */
            $ongoingPROGRAM = DB::table('ongoing')
                ->select('startyear', 'scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
                ->whereNotNull('scholarshipprogram')
                ->groupBy('startyear', 'scholarshipprogram')
                ->get();


            /* $ongoingPROGRAM = Ongoing::select('startyear', 'endyear', 'MF', \DB::raw('COUNT(*) AS MFcount'))
                ->whereNotNull('MF')
                ->groupBy('startyear', 'endyear', 'MF')
                ->get(); */

            $uniqueYears = $ongoingPROGRAM->pluck('startyear')->unique()->sort()->values(); /* For filter */

            /* ScholarshipProgram Filter */
            $ongoingPROGRAMcounter = DB::table('ongoing')
                ->select('scholarshipprogram')
                ->selectRaw('COUNT(*) as scholarshipprogramcount')
                ->whereIn('scholarshipprogram', ['MERIT', 'RA 10612', 'RA 7687'])
                ->groupBy('scholarshipprogram')
                ->get();

            /* Gender */
            $ongoingGender = DB::table('ongoing')
                ->select('startyear', 'MF', DB::raw('COUNT(*) as MFcount'))
                ->whereNotNull('MF')
                ->groupBy('startyear', 'MF')
                ->get();

            $ongoingGendercounter = DB::table('ongoing')
                ->select('MF')
                ->selectRaw('COUNT(*) as MFcount')
                ->whereIn('MF', ['F', 'M'])
                ->groupBy('MF')
                ->get();

            /* ongGoingCourses */
            $courses = Ongoing::select('course', DB::raw('count(*) as courseCount'))
                ->whereNotNull('course')
                ->where('course', '<>', '')
                ->groupBy('course')
                ->get();
            $dataCourses = [
                'labelscourses' => $courses->pluck('course'),
                'datascourses' => $courses->pluck('courseCount'),
            ];

            /* ongcountbyProvinces */ //TODO: to be adjusted.
            $ongoingProvince = DB::table('seis')
                ->select('PROVINCE', DB::raw('COUNT(*) as countProvince'))
                ->groupBy('PROVINCE')
                ->get();
            $dataProvinces = [
                'labelsprovince' => $ongoingProvince->pluck('PROVINCE'),
                'datasprovince' => $ongoingProvince->pluck('countProvince'),
            ];

            /* ongcountbyProvinces */
            $ongoingSchools = DB::table('ongoing')
                ->select('school', DB::raw('count(*) as countSchool'))
                ->groupBy('school')
                ->get();
            $dataSchoool = [
                'labelsschool' => $ongoingSchools->pluck('school'),
                'datasschool' => $ongoingSchools->pluck('countSchool'),
            ];


            $ongoingMovements = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('scholar_statuses.status_name', DB::raw('count(*) as countMovement'))
                ->groupBy('scholar_statuses.status_name')
                ->get();
            $dataMovements  = [
                'labelsmovements' => $ongoingMovements->pluck('status_name'),
                'datasmovements' => $ongoingMovements->pluck('countMovement'),
            ];



            return view('dashboard', compact(
                'ongoingPROGRAM',
                'uniqueYears',
                'ongoingPROGRAMcounter',
                'ongoingGender',
                'ongoingGendercounter',
                'dataCourses',
                'dataProvinces',
                'dataSchoool',
                'dataMovements',
                'startYear',
            ));
        }
    }


    public function getallyearfilter(Request $request)
    {
        $startYear = $request->input('startyear');
        $endYear = $request->input('endyear');

        if ($startYear) {


            $ongoingProvince = DB::table('seis')
                ->select('PROVINCE', DB::raw('COUNT(*) as countProvince'))
                ->groupBy('PROVINCE')
                ->where('year', $startYear)
                ->get();
            $dataProvinces = [
                'labelsprovince' => $ongoingProvince->pluck('PROVINCE'),
                'datasprovince' => $ongoingProvince->pluck('countProvince'),
            ];

            $ongoingPROGRAM = DB::table('ongoing')
                ->select('startyear', 'scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
                ->whereNotNull('scholarshipprogram')
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('startyear', 'scholarshipprogram')
                ->get();

            $uniqueYears = $ongoingPROGRAM->pluck('startyear')->unique()->sort()->values(); /* For filter */

            $ongoingPROGRAMcounter = DB::table('ongoing')
                ->select('scholarshipprogram')
                ->selectRaw('COUNT(*) as scholarshipprogramcount')
                ->whereIn('scholarshipprogram', ['MERIT', 'RA 10612', 'RA 7687'])
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('scholarshipprogram')
                ->get();

            $ongoingGender = DB::table('ongoing')
                ->select('startyear', 'MF', DB::raw('COUNT(*) as MFcount'))
                ->whereNotNull('MF')
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('startyear', 'MF')
                ->get();

            $ongoingGendercounter = DB::table('ongoing')
                ->select('MF')
                ->selectRaw('COUNT(*) as MFcount')
                ->whereIn('MF', ['F', 'M'])
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('MF')
                ->get();


            $ongoingProvince = DB::table('seis')
                ->select('PROVINCE', DB::raw('COUNT(*) as countProvince'))
                ->groupBy('PROVINCE')
                ->whereBetween('year', [$startYear, $endYear])
                ->get();
            $dataProvinces = [
                'labelsprovince' => $ongoingProvince->pluck('PROVINCE'),
                'datasprovince' => $ongoingProvince->pluck('countProvince'),
            ];


            $courses = Ongoing::select('course', DB::raw('count(*) as courseCount'))
                ->whereNotNull('course')
                ->where('course', '<>', '')
                ->where('startyear', $startYear)
                ->groupBy('course')
                ->get();
            $dataCourses = [
                'labelscourses' => $courses->pluck('course'),
                'datascourses' => $courses->pluck('courseCount'),
            ];

            $ongoingSchools = DB::table('ongoing')
                ->select('school', DB::raw('count(*) as countSchool'))
                ->where('startyear', $startYear)
                ->groupBy('school')
                ->get();
            $dataSchoool = [
                'labelsschool' => $ongoingSchools->pluck('school'),
                'datasschool' => $ongoingSchools->pluck('countSchool'),
            ];


            $ongoingMovements = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('scholar_statuses.status_name', DB::raw('count(*) as countMovement'))
                ->where('year', $startYear)
                ->groupBy('scholar_statuses.status_name')
                ->get();
            $dataMovements  = [
                'labelsmovements' => $ongoingMovements->pluck('status_name'),
                'datasmovements' => $ongoingMovements->pluck('countMovement'),
            ];

            return view('dashboard', compact(
                'ongoingPROGRAM',
                'dataProvinces',
                'uniqueYears',
                'ongoingPROGRAMcounter',
                'ongoingGender',
                'ongoingGendercounter',
                'dataCourses',
                'dataProvinces',
                'dataSchoool',
                'dataMovements',
                'startYear',
                'endYear',
            ));
        } else {
            // Debugbar::info($ongoingPROGRAMcounter);
            return response()->json([]);
        }
    }

    public function getprogramchartyearfilter(Request $request)
    {
        $startYear = $request->input('startyear');
        $endYear = $request->input('endyear');
        // Debugbar::info($startYear);

        if ($startYear) {
            $ongoingPROGRAM = DB::table('ongoing')
                ->select('startyear', 'scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
                ->whereNotNull('scholarshipprogram')
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('startyear', 'scholarshipprogram')
                ->get();

            $ongoingPROGRAMcounter = DB::table('ongoing')
                ->select('scholarshipprogram')
                ->selectRaw('COUNT(*) as scholarshipprogramcount')
                ->whereIn('scholarshipprogram', ['MERIT', 'RA 10612', 'RA 7687'])
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('scholarshipprogram')
                ->get();

            return response()->json([
                'ongoingPROGRAM' => $ongoingPROGRAM,
                'ongoingPROGRAMcounter' => $ongoingPROGRAMcounter,
            ]);
        } else {
            // Debugbar::info($ongoingPROGRAMcounter);
            return response()->json([]);
        }
    }


    public function getgenderchartyearfilter(Request $request)
    {
        $startYear = $request->input('startyeargender');
        $endYear = $request->input('endyeargender');

        if ($startYear) {
            $ongoingGender = DB::table('ongoing')
                ->select('startyear', 'MF', DB::raw('COUNT(*) as MFcount'))
                ->whereNotNull('MF')
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('startyear', 'MF')
                ->get();

            $ongoingGendercounter = DB::table('ongoing')
                ->select('MF')
                ->selectRaw('COUNT(*) as MFcount')
                ->whereIn('MF', ['F', 'M'])
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('MF')
                ->get();


            return response()->json([
                'ongoingGender' => $ongoingGender,
                'ongoingGendercounter' => $ongoingGendercounter,
            ]);
        } else {
            // Debugbar::info($ongoingPROGRAMcounter);
            return response()->json([]);
        }
    }


    public function getprovincechartyearfilter(Request $request)
    {
        $startYear = $request->input('startyearprovince');
        $endYear = $request->input('endyearprovince');

        if ($startYear) {

            $ongoingProvince = DB::table('seis')
                ->select('PROVINCE', DB::raw('COUNT(*) as countProvince'))
                ->groupBy('PROVINCE')
                ->where('year', $startYear)
                ->get();
            $dataProvinces = [
                'labelsprovince' => $ongoingProvince->pluck('PROVINCE'),
                'datasprovince' => $ongoingProvince->pluck('countProvince'),
            ];





            return response()->json([
                'dataProvinces' => $dataProvinces,
            ]);
        } else {
            // Debugbar::info($ongoingPROGRAMcounter);
            return response()->json([]);
        }
    }
}
