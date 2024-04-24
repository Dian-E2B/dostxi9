<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Log;
use Yajra\DataTables\DataTables;
use App\Imports\SeiImport;
use App\Models\Gender;
use App\Models\Program;
use App\Models\Scholar_status;
use App\Models\Scholars;
use App\Models\Sei;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facades\Debugbar;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SeiViewController extends Controller
{
    //SEILIST1
    public function seiqualifierview()
    {
        $years = Sei::groupBy('year')->pluck('year');
        return view('seilist', compact('years'));
    }

    public function seiqualifierviewajax(Request $request)
    {
        $currentYear = date('Y');
        $startYear = $request->input('startYear');
        if (empty($startYear)) {
            $seis = Sei::join('programs', 'seis.program_id', '=', 'programs.id')
                ->join('genders', 'seis.gender_id', '=', 'genders.id')
                ->where(function ($query) {
                    $query->whereNull('lacking')
                        ->orWhere('lacking', '=', '');
                })
                ->where('year',  $currentYear) // Add this line to filter by the current year
                ->select('seis.*', 'programs.progname', 'genders.gendername')
                ->get();

            $this->getyear($startYear);
            return DataTables::of($seis)->make(true);
        } else {
            $seis = Sei::join('programs', 'seis.program_id', '=', 'programs.id')
                ->join('genders', 'seis.gender_id', '=', 'genders.id')
                ->where('year', $startYear)
                ->where(function ($query) {
                    $query->whereNull('lacking')
                        ->orWhere('lacking', '=', '');
                })
                ->select('seis.*', 'programs.progname', 'genders.gendername')
                ->get();
            return DataTables::of($seis)->make(true);
        }
    }

    public function getyear($year)
    {
        return response()->json(['currentYear' => $year]);
    }


    public function getOngoingSeilistById($number)
    {

        $result = Sei::where('id', $number)->first();
        if (!$result) {
            return response()->json(['error' => 'Record not found'], 404);
        }
        return response()->json($result);
    }

    public function SaveChangesSeilist(Request $request, $number)
    {
        $record = Sei::where('id', $number)->first();
        if (!$record) {
            return response()->json(['error' => 'Record not found'], 404);
        }
        $record->update($request->all()); // Update the record with the new data
        return response()->json(['message' => 'Changes saved successfully']); // You can return a response if needed
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(view: 'seilist');
    }

    public function store(Request $request)
    {
        $firstRow = Excel::toArray(new SeiImport(), $request->file('excel_file')->getRealPath(), null, \Maatwebsite\Excel\Excel::XLSX)[0][0];
        if ($firstRow !== ['SPAS NO.', 'AppID', 'STRAND', 'program', 'last name', 'first name', 'middle name', 'suffix', 'sex', 'birthday', 'email address', 'contact number', 'house number', 'street', 'village', 'barangay', 'municipality', 'province', 'zipcode', 'district', 'region', 'hsname', 'lacking', 'remarks']) {
            // Redirect back with an error message
            session()->flash('error', "The file is not correct; a column has been deleted. Please check the file.");
            return redirect()->back();
        } else {
            try {

                Excel::import(new SeiImport(), $request->file(key: "excel_file"));
                session()->flash('success', "Records successfully Imported");
                return redirect()->back();
            } catch (\Exception $e) {
                // Handle the error
                // You can log the error, display a user-friendly message, or take other actions
                $errorMessage = $e->getMessage();
                // flash()->addError('There is a problem during upload ');
                echo 'An error occurred: ' . $errorMessage;
            }
        }
    }

    //SEILIST2
    public function seipotientalqualifierview()
    {
        return view('seilist2');
    }

    public function seilistviewajaxpotential()
    {

        $seis2 = Sei::join('programs', 'seis.program_id', '=', 'programs.id')
            ->join('genders', 'seis.gender_id', '=', 'genders.id')
            ->where(function ($query) {
                $query->whereNotNull('lacking')
                    ->orWhere('lacking', '<>', '');
            })
            ->select('seis.*', 'programs.progname', 'genders.gendername', DB::raw('COALESCE(lacking, "") as lacking'))
            ->get();
        /*  Debugbar::info($seis2); */

        return DataTables::of($seis2)->make(true);
    }

    public function edit(Request $request)
    {
        $email = $request->input('email');
        $scholarid = $request->input('SCHOLARID');

        $scholar = Scholars::where('id', $scholarid)->first();
        $sei = Sei::where('id', $scholarid)->first();
        $status = Scholar_status::all();
        $program = Program::all();
        $gender = Gender::all();

        return view('seilist2editpage', compact('scholar', 'sei', 'status', 'program', 'gender'));
    }

    public function saveedit(Request $request)
    {
        // UNIQUEIDENTIFIER
        $sei_id = $request->input('sei_id');

        $sei = Sei::where('id', $sei_id)->first();
        $scholar = Scholars::where('id', $sei_id)->first();
        // dd($sei_id);

        try {
            $scholar->update([
                'fname' => $request->input('schol_fname'),
                'mname' => $request->input('schol_mname'),
                'lname' => $request->input('schol_lname'),
                'suffix' => $request->input('schol_suffix'),
                'email' => $request->input('schol_email'),
                'mobile' => $request->input('schol_mobile'),
                'bday' => $request->input('schol_bday'),
                'scholar_status_id' => $request->input('scholar_status_id'),
            ]);

            $sei->update([
                'strand' => $request->input('sei_strand'),
                'gender_id' => $request->input('sei_gender_id'),
                'program_id' => $request->input('sei_program_id'),
                'municipality' => $request->input('sei_municipality'),
                'province' => $request->input('sei_province'),
                'zipcode' => $request->input('sei_zipcode'),
                'barangay' => $request->input('sei_barangay'),
                'houseno' => $request->input('sei_houseno'),
                'street' => $request->input('sei_street'),
                'region' => $request->input('sei_region'),
                'hsname' => $request->input('sei_hsname'),
                'remarks' => $request->input('sei_remarks'),
                'lacking' => $request->input('sei_lacking'),
                'district' => $request->input('sei_district'),
            ]);

            $sei->save();
            $scholar->save();
            session()->flash('success', "Your changes has been saved.");
            // return redirect('seilist2');
            // return $this->seipotientalqualifierview();
            return redirect()->route('seilist2');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
