<?php

namespace App\Http\Controllers;


use App\Models\Cog;
use App\Models\Cogdetails;
use App\Models\Cogsdraft;
use App\Models\Notification_staffs;
use App\Models\Replyslips;
use App\Models\Scholars;
use App\Models\Sei;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StudentActionsController extends Controller
{
    //
    public function replyslipsave(Request $request)
    {
        // Store the uploaded image in the "public/signatures" directory
        $scholarid = $request->input('scholarid');
        $reason1 = $request->input('reason');
        $fname = Sei::where('id', $scholarid)->value('fname');
        $lname = Sei::where('id', $scholarid)->value('lname');

        $checkreplyslipstatus = Replyslips::where('scholar_id', $scholarid)->value('replyslip_status_id');
        $customstudentsignaturefilename = $scholarid . 'signatures' . time() . '.' . $request->file('signaturestudent')->getClientOriginalExtension();
        $customparentsignaturefilename = $scholarid . 'signatureparent' . time() . '.' . $request->file('signatureparent')->getClientOriginalExtension();
        if ($checkreplyslipstatus == 1) {
            $request->file('signaturestudent')->storeAs('public/signatures', $customstudentsignaturefilename);
            $request->file('signatureparent')->storeAs('public/signatures', $customparentsignaturefilename);
        }

        if ($request->has('acceptcheckbox')) {

            // echo 'acceptcheckbox is checked';
            Replyslips::where('scholar_id', $scholarid)->update([
                'signature' => 'storage/signatures/' . $customstudentsignaturefilename,
                'reason' => $reason1,
                'signatureparents' => 'storage/signatures/' . $customparentsignaturefilename,
                'updated_at' => now(),
                'replyslip_status_id' => 2
            ]);
            return redirect('/student/profile');
        } else if ($request->has('defferedcheckbox')) {

            Replyslips::where('scholar_id', $scholarid)->update([
                'signature' => 'storage/signatures/' . $customstudentsignaturefilename,
                'signatureparents' => 'storage/signatures/' . $customparentsignaturefilename,
                'reason' => $reason1,
                'updated_at' => now(),
                'replyslip_status_id' => 4
            ]);
            return redirect('/student/profile');
        } else if ($request->has('rejectcheckbox')) {

            Replyslips::where('scholar_id', $scholarid)->update([
                'signature' => 'storage/signatures/' . $customstudentsignaturefilename,
                'signatureparents' => 'storage/signatures/' . $customparentsignaturefilename,
                'reason' => $reason1,
                'updated_at' => now(),
                'replyslip_status_id' => 3
            ]);
            return redirect('/student/profile');
        }

        return redirect('/student/profile');
    }




    //GRADES SAVE
    public function cogsave(Request $request)
    {

        $scholarid = $request->input('scholarid');
        $semesterinput = $request->input('semester');
        $startyearinput = $request->input('startyear');

        $customstudentcogfilename = $scholarid . 'cog' . time() . '.' . $request->file('imagegrade')->getClientOriginalExtension();
        $request->file('imagegrade')->storeAs('public/cog', $customstudentcogfilename);

        $customstudentcorfilename = $scholarid . 'cor' . time() . '.' . $request->file('corname')->getClientOriginalExtension();
        $request->file('corname')->storeAs('public/cor', $customstudentcorfilename);


        $data = $request->validate([
            'subjectnames.*.name' => 'required',
            'grades.*.grade' => 'required',
            'units.*.unit' => 'required',
        ]);

        $cogData = [
            'scholar_id' => $scholarid,
            'semester' => $semesterinput,
            'failnum' => 0,
            'cog_status' => 0,
            'startyear' => $startyearinput,
            'endyear' => $startyearinput + 1,
            'date_uploaded' => now(),
            'cog_name' => 'storage/cog/' . $customstudentcogfilename,
            'cor_name' => 'storage/cor/' . $customstudentcorfilename,
        ];


        $isDraft = $request->is_draft == 1;

        $cogData['draft'] = $isDraft ? 1 : 0;

        $cog = Cog::create($cogData);
        $cogId = $cog->id;

        //modified  march 15 2024
        if (!$isDraft) {
            foreach ($data['subjectnames'] as $index => $subject) {
                $cog->cogdetails()->create([
                    'subjectname' => $subject['name'],
                    'grade' => $data['grades'][$index]['grade'],
                    'unit' => $data['units'][$index]['unit'],
                ]);
            }

            $notificationsave = Notification_staffs::create(
                [
                    'scholar_id' =>  $scholarid,
                    'type' =>  'COG & COR',
                    'message' => 'A new COG and COR document has been uploaded.',
                    'data_id' =>  $cogId,
                ]
            );
            if ($notificationsave) {
                return redirect()->back()->with('success', 'Grades submit successfully');
            }
        } else {
            foreach ($data['subjectnames'] as $index => $subject) {
                $cog->cogdetails()->create([
                    'subjectname' => $subject['name'],
                    'grade' => $data['grades'][$index]['grade'],
                    'unit' => $data['units'][$index]['unit'],
                ]);
            }
            return redirect()->back()->with('success', 'Draft saved successfully');
        }
    }

    public function saveDraft(Request $request)
    {


        if ($request->is_delete == 1) {
            $cog_id = $request->input('cog_id');
            $cog = Cog::find($cog_id);
            if ($cog) {
                $cog->delete();

                $cogFilePath = $cog['cog_name'];
                $corFilePath = $cog['cor_name'];
                $storageDirectorycog = 'storage/cog/';
                $storageDirectorycor = 'storage/cor/';
                $cogFileName = str_replace($storageDirectorycog, '', $cogFilePath); //COG
                $corFileName = str_replace($storageDirectorycor, '', $corFilePath); //COR
                if ($cogFilePath && Storage::disk('public')->exists('cog/' . $cogFileName)) {
                    Storage::disk('public')->delete('cog/' . $cogFileName);
                    Storage::disk('public')->delete('cor/' . $corFileName);
                    return redirect()->back()->with('success', 'Draft and Files deleted successfully');
                }
            }
        } else {
            $scholarid = $request->input('scholar_id');
            /* $customstudentprospectusfilename = $scholarid . 'prospectus' . time() . '.' . $request->file('prospectus1')->getClientOriginalExtension();
            $request->file('prospectus1')->storeAs('public/prospectus', $customstudentprospectusfilename);*/
            $cog_id = $request->input('cog_id');
            $cog = Cog::find($cog_id);
            if ($cog) {
                // Update the draft column to 0
                $cog->update([
                    'draft' => 0,
                    /*'cog_name' => 'storage/prospectus/' . $customstudentprospectusfilename,*/
                ]);
                return redirect()->back()->with('success', 'Draft submitted successfully');
            }
        }
    }
}
