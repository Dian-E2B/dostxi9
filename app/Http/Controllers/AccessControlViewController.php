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
use App\Services\MainServices;
use Illuminate\Support\Facades\Log;

class AccessControlViewController extends Controller
{
    protected $MainServices;

    public function __construct(MainServices $MainServices)
    {
        $this->MainServices = $MainServices;
    }

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
        $data_id = $request->input('namedata_id');
        $ifscholar_id = Sei::find($scholar_id);
        $ifscholar_idslip = Replyslips::where('scholar_id', $scholar_id)->select('reply_status_id');

        if ($request->input("nameprocess") == "verify") {
            $ifscholarstatusupdate  =  $ifscholar_id->update(['scholar_status_id' => 2]);
            $ifscholar_idslipupdate  =  $ifscholar_idslip->update(['replyslip_status_id' => 5]);
            if ($ifscholarstatusupdate && $ifscholar_idslipupdate) {
                Notification_schols::create( //add notif to scholar
                    [
                        'type' => 'First Requirements',
                        'message' => 'Your requirements has been verified!',
                        'data_id' =>  $data_id,
                        'scholar_id' =>  $scholar_id,
                    ]
                );
                Notification_staffs::where('data_id', $data_id)->delete();
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

            $semester = $scholarCog->semester;
            $startyear = $scholarCog->startyear;

            $scholarCogdeletenotif = Notification_staffs::where('data_id', $id)->first();
            if ($scholarCogdeletenotif) {
                $scholarCogdeletenotif->delete();
                $result = $this->MainServices->enrollscholartoongoing($scholarCog->scholar_id, $semester, $startyear);
                if ($result) {
                    Log::info('Session data before redirect2:', session()->all());
                    return back()->with('approved', 'COG and COR has been approved scholar is now appended to ongoing!');
                }
            }
        }
    }
}
