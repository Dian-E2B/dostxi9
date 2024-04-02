<?php

namespace App\Http\Controllers;

use App\Models\Notification_schols;
use App\Models\Notification_staffs;
use Illuminate\Http\Request;
use App\Models\Thesis;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
{
    //
    public function finalmanuscriptresubmit(Request $request) //SCHOLAR
    {
        $thesisid = $request->input('thesis_id');
        $finManusPDF = $request->file('fin_manus');
        $Thesis = Thesis::find($thesisid);

        $customstudentfinalmanus = Auth::user()->scholar_id . 'finalmanuscript' . time() . '.' . $finManusPDF->getClientOriginalExtension();
        $finManusPDF->storeAs('public/finalmanus', $customstudentfinalmanus);

        $thesisFilePath  = $Thesis['finalmanuscript_details'];
        $storageDirectory = 'storage/finalmanus/';
        $thesisFileName = str_replace($storageDirectory, '', $thesisFilePath);

        if (!$thesisid) {
            echo 'walay thesis id';
        } elseif (!$finManusPDF) {
            echo 'walay remarksfinal';
        } else {
            if (!$Thesis) {
                echo 'wala nakita ang thesis id';
            } else {
                if (!Storage::disk('public')->delete('finalmanus/' . $thesisFileName)) {
                    echo "wala na delete";
                } else {
                    $Thesis->finalmanus_status = "Pending";
                    $Thesis->finalmanuscript_details = "storage/finalmanus" . $customstudentfinalmanus;
                    $Thesis->save();
                    Notification_staffs::create(
                        [
                            'scholar_id' => Auth::user()->scholar_id,
                            'type' => 'Final Manuscript',
                            'message' => 'An updated final manuscript has been uploaded',
                            'data_id' => $thesisid,
                            'updated_at' => now(),
                        ]
                    );
                    return redirect()->back()->with('success', 'Final Manuscript reuploaded successfully');
                }
            }
        }
    }
    public function finalmanuscriptaction(Request $request) //STAFF
    {
        $action = $request->input('action');
        $thesisid = $request->input('thesis_id');
        $remarksfinal = $request->input('finalremarks');
        $Thesis = Thesis::find($thesisid);
        if (!$action) {
            echo "no action";
        } elseif (!$thesisid) {
            echo "No Thesis ID";
        } elseif (!$Thesis) {
            echo "Di makita ang thesis";
        } else {
            if ($action == "Approve") {
                $Thesis->finalmanus_status = 'Approved';
                $Thesis->updated_at = now();
                $Thesis->save();
                Notification_schols::create(
                    [
                        'type' => 'Final Manuscript',
                        'message' => 'Congratulations! your final manuscript has been approved!',
                        'scholar_id' => $Thesis->scholar_id,
                        'data_id' => $thesisid,
                    ]
                );
                Notification_staffs::where('data_id', $thesisid)->first()->delete();
                return back()->with('approved', 'Final Manuscript Approved.');
            } else {
                if (!$remarksfinal) {
                    echo "Di makita ang remarks";
                } else {
                    $Thesis->finalmanus_status = 'Disapproved';
                    $Thesis->updated_at = now();
                    $Thesis->finalmanus_remarks =  $remarksfinal;
                    $Thesis->save();
                    Notification_schols::create(
                        [
                            'type' => 'Final Manuscript',
                            'message' => 'Your final manuscript has been disapproved! Please see remarks',
                            'scholar_id' => $Thesis->scholar_id,
                            'data_id' => $thesisid,
                        ]
                    );
                    Notification_staffs::where('data_id', $thesisid)->first()->delete();
                    return back()->with('disapproved', 'Final Manuscript Disapproved.');
                }
            }
        }
    }

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
