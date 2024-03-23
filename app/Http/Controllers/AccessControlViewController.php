<?php

namespace App\Http\Controllers;

use App\Models\Cog;
use App\Models\Notification_schols;
use App\Models\Notification_staffs;
use App\Models\Ongoing;
use App\Models\Replyslips;
use App\Models\Scholar_requirements;
use App\Models\Sei;
use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\alert;
use Illuminate\Support\Facades\Validator;

class AccessControlViewController extends Controller
{

    public function index()
    {
        try {
            $seisallstatus = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.*', 'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '<>', 0)
                ->get();

            return view('accesscontrol', compact('seisallstatus'));
        } catch (\Exception $e) {

            // flash()->addError('Empty Records' . $e->getMessage());

            return redirect()->back();
        }
    }


    public function accesscontrolpendingview()
    {
        try {


            $replyslipsandscholarjoinpending = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 1)
                ->get();

            // dd($$$$$);
            return view('accesscontrol', compact('replyslipsandscholarjoinpending'));
        } catch (\Exception $e) {

            return redirect()->back();
        }
    }



    public function accesscontrolenrolledview()
    {

        try {
            $replyslipsjoinscholarenrolled =  DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 3)
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholarenrolled'));
        } catch (\Exception $e) {

            return redirect()->back();
        }
    }

    public function accesscontroldeferredview()
    {

        try {
            $replyslipsjoinscholardeferred = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 4)
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholardeferred'));
        } catch (\Exception $e) {

            return redirect()->back();
        }
    }

    public function accesscontrolLOAview()
    {

        try {
            $replyslipsjoinscholarLOA = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 5)
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholarLOA'));
        } catch (\Exception $e) {

            return redirect()->back();
        }
    }

    public function accesscontrolongoingview()
    {

        try {
            $replyslipsjoinscholarongoing = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 2)
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholarongoing'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function accesscontrolterminatedview()
    {

        try {
            $seisterminated = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 6)
                ->get();
            return view('accesscontrol', compact('seisterminated'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function enrollscholartoongoing(Request $request, $id)
    {
        $seisourcerecord = Sei::find($id);


        // Check if the record exists
        /* if ($seisourcerecord) {
            // Access the value of the 'year' column
            $yearValue = $seisourcerecord->year;
            $genderValue = $seisourcerecord->gender_id;

            if ($genderValue == 1) {
                $genderValue = "F";
            } else {
                $genderValue = "M";
            }

            $currentYear = now()->year;
            // Create a new record in the destination table
            $destinationRecord = new Ongoing();
            $destinationRecord->BATCH = $yearValue;
            $destinationRecord->NUMBER = $seisourcerecord->id; // Replace with actual column names
            $destinationRecord->NAME = $seisourcerecord->lname . ", " . $seisourcerecord->fname . " " . $seisourcerecord->mname;
            $destinationRecord->MF =  $genderValue;
            $destinationRecord->SCHOLARSHIPPROGRAM = null;
            $destinationRecord->SCHOOL = null;
            $destinationRecord->COURSE = null;
            $destinationRecord->GRADES = null;
            $destinationRecord->SummerREG = null;
            $destinationRecord->REGFORMS = null;
            $destinationRecord->REMARKS = null;
            $destinationRecord->STATUSENDORSEMENT = NULL;
            $destinationRecord->STATUSENDORSEMENT2 = NULL;
            $destinationRecord->STATUSENDORSEMENT2 = NULL;
            $destinationRecord->NOTATIONS = null;
            $destinationRecord->SUMMER = NULL;
            $destinationRecord->FARELEASEDTUITION = NULL;
            $destinationRecord->FARELEASEDTUITIONBOOKSTIPEND = NULL;
            $destinationRecord->LVDCAccount = NULL;
            $destinationRecord->HVCNotes = NULL;
            $destinationRecord->startyear =  $currentYear;
            $destinationRecord->endyear = $currentYear + 1;
            $destinationRecord->semester = 1;

            try {
                $destinationRecord->save();
                if ($destinationRecord) {
                    notyf()
                        ->position('x', 'center')
                        ->position('y', 'right')
                        ->duration(2000) // 2 seconds
                        ->addSuccess('Your application has been received.');
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                    return redirect()->route('accesscontrolenrolled');
                }
            } catch (\Exception $e) {
                // Check if it's a unique constraint violation
                if ($e->getCode() == 23000) {
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                    return redirect()->route('accesscontrolenrolled')->with('success', 'Your application has been received');
                } else {
                    // Handle other database-related exceptions
                }
            }
        } */
    }

    public function scholar_information(Request $request, $id)
    {
        $seisourcerecord = Sei::find($id);
        $scholarrequirements = Scholar_requirements::where('scholar_id', $id)->first();
        $cogpassed = Cog::where('scholar_id', $id)->get();
        $thesispassed = Thesis::where('scholar_id', $id)->get();
        return view('scholar_information', compact('seisourcerecord', 'scholarrequirements', 'cogpassed', 'thesispassed'));
    }

    public function scholarverifyendorse(Request $request)
    {
        $scholar_id = $request->input('namescholar_id');
        $ifscholar_id = Sei::find($scholar_id);
        $ifscholar_idslip = Replyslips::where('scholar_id', $scholar_id)->select('reply_status_id');

        if ($request->input("nameprocess") == "verify") {
            $ifscholarstatusupdate  =  $ifscholar_id->update(['scholar_status_id' => 2]);
            $ifscholar_idslipupdate  =  $ifscholar_idslip->update(['replyslip_status_id' => 5]);
            if ($ifscholarstatusupdate && $ifscholar_idslipupdate) {
                session()->flash('success');
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } else {
        }
    }

    public function requirements_view($id)
    {
        $scholarrequirements = Scholar_requirements::where('scholar_id', $id)->first();
        return response()->json($scholarrequirements);
    }

    public function scholarcog($id)
    {
        $scholarcog = Cog::where('id', $id)->first();
        return response()->json($scholarcog);
    }

    public function scholarthesis($id)
    {
        $scholarthesis = Thesis::where('id', $id)->first();
        return response()->json($scholarthesis);
    }

    public function approvecogcor(Request $request, $id)
    {

        $disapprovecor = $request->input('disapprovecor');
        $disapprovecor_remarks = $request->input('cogremarks');

        if ($disapprovecor == "0") { //if disapproved,
            $scholarCog = Cog::where('id', $id)->first();
            $scholarCog->cogcor_status = "disapproved";
            $scholarCog->cogcor_remarks =  $disapprovecor_remarks;
            $scholarCog->save();

            $scholarCogdeletenotif = Notification_staffs::where('data_id', $id)->first(); //find the notif id

            $scholarCogdeletenotif->delete(); //clean notif

            Notification_schols::create( //add notif to scholar
                [
                    'type' => 'COG & COR',
                    'message' => 'Your Cog & Cor uploaded has been disapproved. Please see remarks for details.',
                    'data_id' =>  $id,
                    'scholar_id' =>  $scholarCog->scholar_id,
                ]
            );
            return back()->with('disapproved', 'COG and COR has been disapproved.');
        } else { //if approved
            $scholarCog = Cog::where('id', $id)->first();
            $scholarCog->cogcor_status = "approved";
            $scholarCog->save();

            $scholarCogdeletenotif = Notification_staffs::where('data_id', $id)->first();
            if ($scholarCogdeletenotif) {
                $scholarCogdeletenotif->delete();
                return back()->with('approved', 'COG and COR has been approved!');
            }
        }
    }

    public function approvethesis(Request $request)

    {
        $thesisid = $request->input('thesis_id');
        $buttonValue = $request->input('action');
        $thesisidget = Thesis::find($thesisid);

        $request->validate([
            'action' => 'required',
            'thesis_id' => 'required',
        ]);

        if ($buttonValue == 'approve') {

            $thesisidget->thesis_status = 'Approved';
            $thesisidget->save();
            Notification_schols::create(
                [
                    'scholar_id' => $thesisidget->scholar_id,
                    'data_id' => $thesisid,
                    'type' => 'Thesis',
                    'message' => 'Your Thesis has been approved!',
                ]
            );
            $Noti_staff = Notification_staffs::where('data_id', $thesisid)->first();
            if ($Noti_staff) {
                $Noti_staff->delete();
            }
            return back()->with('approved', 'Thesis has been approved!');
        } elseif ($buttonValue == 'disapprove') {
            $disapprovethesis_remarks = $request->input('thesisremarks');
            $request->validate([
                'thesisremarks' => 'required',
            ]);
            $thesisidget->thesis_status = 'Disapproved';
            $thesisidget->thesis_remarks = $disapprovethesis_remarks;
            $thesisidget->save();
            $Noti_staff = Notification_staffs::where('data_id', $thesisid)->first();
            $Noti_staff->delete();
            Notification_schols::create(
                [
                    'scholar_id' => $thesisidget->scholar_id,
                    'data_id' => $thesisid,
                    'type' => 'Thesis',
                    'message' => 'Your Thesis has been Disapproved! Please see remarks.',
                ]
            );
            return back()->with('disapproved', 'Thesis has been disapproved.');
        }
    }
}
