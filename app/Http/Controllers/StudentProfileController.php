<?php

namespace App\Http\Controllers;

use App\Models\Replyslips;
use App\Models\Sei;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    //
    public function index()
    {

        $userId = auth()->id();
        $studentuser = Student::where('id', $userId)->first();
        $scholarId = $studentuser->scholar_id;

        $scholarstatusid = Sei::where('id', $scholarId)->value('scholar_status_id'); //show status id
        $scholar_endorsed_status_id = Sei::where('id', $scholarId)->value('endorsed_status');
        $scholarfullinfo = Sei::where('id', $scholarId)->select('fname', 'mname', 'lname', 'mobile', 'program_id', 'email', 'barangay', 'province', 'municipality', 'zipcode', 'gender_id', 'course', 'school')->first(); //show fullname
        $replyslips = Replyslips::where('scholar_id', $scholarId)->get();
        $replyslipstatus = Replyslips::where('scholar_id', $scholarId)->value('replyslip_status_id');
        if ($replyslipstatus != 5) {
            return view('student.requirements', compact('scholarId', 'replyslips', 'replyslipstatus', 'scholarstatusid', 'scholarfullinfo', 'scholar_endorsed_status_id')); //DASHBOARD VIEW
        } else {
            return view('student.profile', compact('scholarId', 'replyslips', 'replyslipstatus', 'scholarstatusid', 'scholarfullinfo')); //DASHBOARD VIEW
        }
    }


    public function checkaccnumber()
    {

        $getaccnumber = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->select('accnumber_name', 'ac_remarks', 'ac_status')
            ->first();


        return response()->json(['getaccnumber' => $getaccnumber]);
    }


    public function checkrequirementstatuses()
    {
        $getallstatuses = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->select('sa_status', 'p_status', 'ac_status', 'inf_status', 'cor_status', 'so_status')
            ->first();


        return response()->json(['getallstatuses' => $getallstatuses]);
    }

    public function setaccnumber(Request $request)
    {

        $getaccnumbername = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->value('accnumber_name');

        $storageDirectory = 'storage/accnumber/';
        $accnumberFileName = str_replace($storageDirectory, '', $getaccnumbername);

        if ($request->hasFile('accnumberfile')) {
            $accnumberfile = $request->file('accnumberfile');
            $accnumbername = Auth::user()->scholar_id . 'accnumber' . time() . '.' . $accnumberfile->getClientOriginalExtension();
            if ($getaccnumbername && Storage::disk('public')->exists('accnumber/' . $accnumberFileName)) {
                Storage::disk('public')->delete('accnumber/' . $accnumberFileName);
            }
            $storesaccnumbername = $accnumberfile->storeAs('public/accnumber', $accnumbername);
            if ($storesaccnumbername) {
                DB::table('accnumber')
                    ->where('scholar_id', Auth::user()->scholar_id)
                    ->update([
                        'accnumber_name' => 'storage/accnumber/' . $accnumbername,
                        'updated_at' => now(),
                        'status' => 0
                    ]);
            }
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            return response()->json(['error' => 'No file uploaded']);
        }
    }


    public function checkcorfirst()
    {

        $getcorfirst = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->select('cor_name', 'cor1_remarks', 'cor_status')
            ->first();


        return response()->json(['getcorfirst' => $getcorfirst]);
    }

    public function setcorfirst(Request $request)
    {

        $getcor_name = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->value('cor_name');

        $storageDirectory = 'storage/cor/';
        $acorFileName = str_replace($storageDirectory, '', $getcor_name);

        if ($request->hasFile('corfirstfile')) {
            $corfile = $request->file('corfirstfile');
            $corname = Auth::user()->scholar_id . 'cor' . time() . '.' . $corfile->getClientOriginalExtension();
            if ($getcor_name && Storage::disk('public')->exists('cor/' . $corfile)) {
                Storage::disk('public')->delete('cor/' . $acorFileName);
            }
            $storescorname = $corfile->storeAs('public/cor', $corname);
            if ($storescorname) {
                DB::table('cor_firstreq')
                    ->where('scholar_id', Auth::user()->scholar_id)
                    ->update([
                        'cor_name' => 'storage/cor/' . $corname,
                        'updated_at' => now(),
                        'status' => 0
                    ]);
            }
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            return response()->json(['error' => 'No file uploaded']);
        }
    }


    public function checkprospectus()
    {

        $getprospectus = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->select('prospectus_name', 'p_remarks', 'p_status')
            ->first();

        return response()->json(['getprospectus' => $getprospectus]);
    }

    public function setprospectus(Request $request)
    {

        $getprospectus_name = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->value('prospectus_name');

        $storageDirectory = 'storage/prospectus/';
        $proscpectusFileName = str_replace($storageDirectory, '', $getprospectus_name);

        if ($request->hasFile('prospectusfile')) {
            $prospectusfile = $request->file('prospectusfile');
            $prospectusname = Auth::user()->scholar_id . 'prospectus' . time() . '.' . $prospectusfile->getClientOriginalExtension();
            if ($getprospectus_name && Storage::disk('public')->exists('prospectus/' . $proscpectusFileName)) {
                $deleteprospectus =  Storage::disk('public')->delete('prospectus/' . $proscpectusFileName);
                if ($deleteprospectus) {
                    $storesprospectus = $prospectusfile->storeAs('public/prospectus', $prospectusname);
                    if ($storesprospectus) {
                        DB::table('prospectus')
                            ->where('scholar_id', Auth::user()->scholar_id)
                            ->update([
                                'prospectus_name' => 'storage/prospectus/' . $prospectusname,
                                'updated_at' => now(),
                                'status' => 0
                            ]);
                    }
                }
            }
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            return response()->json(['error' => 'No file uploaded']);
        }
    }

    public function checkscholaroath()
    {

        $getscholaroath = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->select('scholaroath_name', 'so_remarks', 'so_status')
            ->first();

        return response()->json(['getscholaroath' => $getscholaroath]);
    }

    public function setscholaroath(Request $request)
    {

        $getscholaroath_name = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->value('scholaroath_name');

        $storageDirectory = 'storage/scholaroath/';
        $scholaroathnameFileName = str_replace($storageDirectory, '', $getscholaroath_name);

        if ($request->hasFile('scholaroathFile')) {
            $scholaroathfile = $request->file('scholaroathFile');
            $scholaroathname = Auth::user()->scholar_id . 'scholaroath' . time() . '.' . $scholaroathfile->getClientOriginalExtension();
            if ($getscholaroath_name && Storage::disk('public')->exists('scholaroath/' . $scholaroathnameFileName)) {
                $deleteprospectus =  Storage::disk('public')->delete('scholaroath/' . $scholaroathnameFileName);
                if ($deleteprospectus) {
                    $storesprospectus = $scholaroathfile->storeAs('public/scholaroath', $scholaroathname);
                    if ($storesprospectus) {
                        DB::table('scholaroath')
                            ->where('scholar_id', Auth::user()->scholar_id)
                            ->update([
                                'scholaroath_name' => 'storage/scholaroath/' . $scholaroathname,
                                'updated_at' => now(),
                                'status' => 0
                            ]);
                    }
                }
            }
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            return response()->json(['error' => 'No file uploaded']);
        }
    }

    public function checkinfosheet()
    {
        $getinfosheet = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->select('inf_remarks', 'infosheet_name', 'inf_status')
            ->first();
        if (empty($getinfosheet)) {
            return response()->json(['error' => 'Wala']);
        } else {
            return response()->json(['getinfosheet' => $getinfosheet]);
        }
    }

    public function setinfosheet(Request $request)
    {
        $thisrecordname = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->value('infosheet_name');

        $thisfor = 'infosheet';
        $thisfile = $request->file('infosheetFile');

        $storageDirectory = 'storage/' . $thisfor . '/';
        $thisFileName = str_replace($storageDirectory, '', $thisrecordname);
        if ($request->hasFile('infosheetFile')) {
            $thiscustomfilename = Auth::user()->scholar_id . $thisfor . time() . '.' . $thisfile->getClientOriginalExtension();
            if ($thisrecordname && Storage::disk('public')->exists($thisfor . '/' . $thisFileName)) {
                $delete =  Storage::disk('public')->delete($thisfor . '/' . $thisFileName);
                if ($delete) {
                    $store = $thisfile->storeAs('public/' . $thisfor, $thiscustomfilename);
                    if ($store) {
                        DB::table('informationsheet')
                            ->where('scholar_id', Auth::user()->scholar_id)
                            ->update([
                                'infosheet_name' => 'storage/' . $thisfor . '/' . $thiscustomfilename,
                                'updated_at' => now(),
                                'status' => 0
                            ]);
                    }
                }
            }
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            return response()->json(['error' => 'No file uploaded']);
        }
    }

    public function checkscholaragreement()
    {
        $getscholaragreement = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->select('scholarshipagreement_name', 'sa_remarks', 'sa_status')
            ->first();
        return response()->json(['getscholaragreement' => $getscholaragreement]);
    }

    public function setscholaragreement(Request $request)
    {
        $thisrecordname = DB::table('scholar_requirement_view')
            ->where('scholar_id', Auth::user()->scholar_id)
            ->value('scholarshipagreement_name');

        $thisfor = 'scholarshipagreement';
        $thisfile = $request->file('scholaragreementFile');

        $storageDirectory = 'storage/' . $thisfor . '/';
        $thisFileName = str_replace($storageDirectory, '', $thisrecordname);
        if ($request->hasFile('scholaragreementFile')) {
            $thiscustomfilename = Auth::user()->scholar_id . $thisfor . time() . '.' . $thisfile->getClientOriginalExtension();
            if ($thisrecordname && Storage::disk('public')->exists($thisfor . '/' . $thisFileName)) {
                $delete =  Storage::disk('public')->delete($thisfor . '/' . $thisFileName);
                if ($delete) {
                    $store = $thisfile->storeAs('public/' . $thisfor, $thiscustomfilename);
                    if ($store) {
                        DB::table($thisfor)
                            ->where('scholar_id', Auth::user()->scholar_id)
                            ->update([
                                'scholarshipagreement_name' => 'storage/' . $thisfor . '/' . $thiscustomfilename,
                                'updated_at' => now(),
                                'status' => 0
                            ]);
                    }
                }
            }
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            return response()->json(['error' => 'No file uploaded']);
        }
    }

    public function editschoolcourse(Request $request)
    {
        $scholar_id = Auth::user()->scholar_id;
        $school = request()->input('school');
        $course = request()->input('course');
        $mobile = request()->input('mobile');
        $email = request()->input('email');

        $seis = Sei::find($scholar_id);
        if ($seis) {
            $seis->school =  $school;
            $seis->course =  $course;
            $seis->email =  $email;
            $seis->mobile =  $mobile;
            $seis->save();
            session()->flash('success', 'Profile updated.');
            return redirect()->route('student.profile');
        } else {
            echo "Record not found.";
        }
    }



    public function verifyaccnumber(Request $request)
    {
        $decision = $request->input('decisionacc');
        $scholarId = $request->input('scholar_id');
        $remarks = $request->input('remarks');

        $accnumber = DB::table('accnumber')->where('scholar_id', $scholarId)->first();
        if ($decision === 'no') {
            if ($accnumber) {
                DB::table('accnumber')
                    ->where('scholar_id', $scholarId)
                    ->update([
                        'remarks' => $remarks,
                        'status' => 0
                    ]);
                return response()->json(['message' => 'Accnumber processed successfully']);
            } else {
            }
        } else {
            DB::table('accnumber')
                ->where('scholar_id', $scholarId)
                ->update([
                    'status' => 1
                ]);
            return response()->json(['message' => 'Accnumber processed successfully']);
        }
    }
}
