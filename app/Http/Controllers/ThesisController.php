<?php

namespace App\Http\Controllers;

use App\Models\Notification_schols;
use App\Models\Notification_staffs;
use Illuminate\Http\Request;
use App\Models\Thesis;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class ThesisController extends Controller
{
    //
    public function finalmanuscriptsubmit(Request $request) //SCHOLAR
    {
        $thesisID = $request->input('thesis_id');
        $finManusPDF = $request->file('fin_manus');

        if (!$thesisID) {
            echo "no thesis ID";
        } elseif (!$finManusPDF) {
            echo "No final manuscript";
        } else {
            $customstudentfinalmanus = Auth::user()->scholar_id . 'finalmanuscript' . time() . '.' . $finManusPDF->getClientOriginalExtension();
            $storescholarfinalmanus = $finManusPDF->storeAs('public/finalmanus', $customstudentfinalmanus);
            $thesis = Thesis::find($thesisID);
            if ($thesis && $storescholarfinalmanus && $customstudentfinalmanus) {
                $thesis->finalmanuscript_details = 'storage/finalmanus/' . $customstudentfinalmanus;
                $thesis->save();
                Notification_staffs::create(
                    [
                        'scholar_id' => $thesis->scholar_id,
                        'type' => 'Final Manuscript',
                        'message' => 'A new Final Manuscript has been Submitted!',
                        'data_id' => $thesisID,
                        'updated_at' => now(),
                    ]
                );
                return back()->with('success', 'Final Manuscript submitted.');
            } else {
                echo "Record not found.";
            }
        }
    }

    public function thesisview()
    {
        $scholarId = Auth::user()->scholar_id;
        $thesis = Thesis::where('scholar_id', $scholarId)->first();
        return view('student.thesis', ['thesis' => $thesis]);
    }

    public function thesisview2($data_id)
    {
        $thesisnotif = Notification_schols::where('data_id', $data_id)->first();
        if ($thesisnotif->type == "Thesis") {
            Notification_schols::where('data_id', $data_id)->delete();
            return redirect()->route('student/thesis');
        }
        return redirect()->route('student/thesis');
    }

    public function thesissubmit(Request $request)   //THESIS SUBMIT SECTION
    {
        $scholarId = Auth::user()->scholar_id;
        $customstudentsthesis = $scholarId . 'thesis' . time() . '.' . $request->file('thesispdf')->getClientOriginalExtension();
        $storescholarshipagreement = $request->file('thesispdf')->storeAs('public/thesis', $customstudentsthesis);

        if ($storescholarshipagreement) {
            $thesis = Thesis::create([
                'scholar_id' => $scholarId,
                'thesis_details' => 'storage/thesis/' . $customstudentsthesis,
                'thesis_status' => 'pending',
                'thesis_remarks' => null,
                'updated_at' => now(),
                'created_at' => now(),
            ]);
            if ($thesis) {
                Notification_staffs::create(
                    [
                        'scholar_id' => $scholarId,
                        'type' => 'Thesis',
                        'message' => 'A new thesis proposal has been submitted!',
                        'data_id' => $thesis->id,
                    ]
                );
                return response()->json(['message' => 'Thesis submitted successfully.'], 200);
                /*  session()->flash('uploaded', 'Thesis Proposal Submitted'); */
                /*  return back(); */
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

    public function scholarthesis($id)
    {
        $scholarthesis = Thesis::where('id', $id)->first();
        return response()->json($scholarthesis);
    }
}
