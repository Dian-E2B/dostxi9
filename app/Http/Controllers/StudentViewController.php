<?php

namespace App\Http\Controllers;

use App\Models\Cogdetails;
use App\Models\Program;
use App\Models\Replyslips;
use App\Models\Requestdocs;
use App\Models\Scholar_requirements;
use App\Models\Scholars;
use App\Models\Sei;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Smalot\PdfParser\Parser;

class StudentViewController extends Controller
{
    //
    public function index()
    {

        $userId = auth()->id();
        $studentuser = Student::where('id', $userId)->first();
        $scholarId = $studentuser->scholar_id;

        $scholarstatusid = Sei::where('id', $scholarId)->value('scholar_status_id'); //show status id
        $scholarfullinfo = Sei::where('id', $scholarId)->select('fname', 'mname', 'lname', 'mobile', 'program_id', 'email', 'barangay', 'province', 'municipality', 'zipcode', 'gender_id')->first(); //show fullname

        $replyslips = Replyslips::where('scholar_id', $scholarId)->get();
        $replyslipstatus = Replyslips::where('scholar_id', $scholarId)->value('replyslip_status_id');

        return view('student.profile', compact('scholarId', 'replyslips', 'replyslipstatus', 'scholarstatusid', 'scholarfullinfo')); //DASHBOARD VIEW
    }

    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function savefirstrequirements(Request $request)
    {
        /* $scholarshipagreement1 = $request->input('scholarshipagreement'); */
        /*   $informationsheet1 = $request->input('informationsheet'); */
        /* $scholaroath1 = $request->input('scholaroath'); */
        /* $prospectus1 = $request->input('prospectus'); */
        $scholarid1 = $request->input('scholarid');

        $customstudentscholarshipagreement = $scholarid1 . 'scholarshipagreement' . time() . '.' . $request->file('scholarshipagreement')->getClientOriginalExtension();
        $storescholarshipagreement = $request->file('scholarshipagreement')->storeAs('public/documents', $customstudentscholarshipagreement);

        $customstudentsinformationsheet = $scholarid1 . 'informationsheet' . time() . '.' . $request->file('informationsheet')->getClientOriginalExtension();
        $storeinformationsheet = $request->file('informationsheet')->storeAs('public/documents', $customstudentsinformationsheet);

        $customstudentscholaroath = $scholarid1 . 'scholaroath' . time() . '.' . $request->file('scholaroath')->getClientOriginalExtension();
        $storescholaroath = $request->file('scholaroath')->storeAs('public/documents', $customstudentscholaroath);

        $customstudentprospectusfilename = $scholarid1 . 'prospectus' . time() . '.' . $request->file('prospectus')->getClientOriginalExtension();
        $storeprospectus = $request->file('prospectus')->storeAs('public/documents', $customstudentprospectusfilename);


        if ($storeprospectus && $storescholarshipagreement && $storescholaroath && $storeinformationsheet) {
            $Scholar_requirements = Scholar_requirements::create([
                'scholar_id' => $scholarid1,
                'date_uploaded' => now(),
                'scholarshipagreement' => 'storage/documents/' . $customstudentscholarshipagreement,
                'informationsheet' => 'storage/documents/' . $customstudentsinformationsheet,
                'scholaroath' => 'storage/documents/' . $customstudentscholaroath,
                'prospectus' => 'storage/documents/' . $customstudentprospectusfilename,
                'scholarid' => $scholarid1,
            ]);

            $replySlips = Replyslips::where('scholar_id', $scholarid1)->update(['replyslip_status_id' => 6]);
            if ($Scholar_requirements &&  $replySlips) {
                notyf()
                    ->position('y', 'top')
                    ->position('x', 'right')
                    ->duration(4000) // 4 seconds
                    ->addSuccess('Your requirements has been uploaded.');
                return redirect('student/dashboard');
            } else {
                return back();
            }
        }
    }

    public function submitreqsperiodic()
    {
        return view('student.submitreqs');
    }

    public function submitreqsperiodicsave(Request $request)
    {
        $semester = $request->input('semestername');
        $acadyear = $request->input('yearname');
        $scholarid = $request->input('scholaridname');

        $customcorname = $scholarid . 'corname' . time() . '.' . $request->file('corname')->getClientOriginalExtension(); //put custom filenamefor cor
        $storecor = $request->file('corname')->storeAs('public/cor', $customcorname); //store file name cor

        $customcogname = $scholarid . 'cogname' . time() . '.' . $request->file('cogname')->getClientOriginalExtension(); //put custom filename cog
        $storecog = $request->file('cogname')->storeAs('public/cog', $customcogname); //store file name for cog


        /*    if ($storecor) {
            $cogs_
        } else {
            # code...
        } */


        /*   $request->validate([
            'corname' => 'required|mimes:pdf|max:2048' // Maximum file size of 2MB
        ]);
 */

        /*  if ($request->hasFile('corname')) {
            $pdfFilePath = $request->file('corname')->path();
            $parser = new Parser();
            try {
                $pdf = $parser->parseFile($pdfFilePath);
                $text = $pdf->getText();
                $text = str_replace('\n', PHP_EOL, $text);
                return response()->json(['text' => $text]);
            } catch (\Exception $e) {
                // Handle the exception (e.g., log it, display a user-friendly error message)
                return response()->json(['error' => 'Failed to parse the PDF file.'], 500);
            }
        } */
    }

    public function replyslipview()
    {

        $userId = auth()->id();
        $studentuser = Student::where('id', $userId)->first();

        if ($studentuser) {
            // Retrieve all reply slip records with the matching scholar_id
            $scholarId = $studentuser->scholar_id;
            $programid = Sei::where('id', $scholarId)->value('program_id');
            $programname = Program::where('id', $programid)->value('progname');
            // $programstudent = $scholar->program;

            // dd($scholarId,$programname);
            $replyslips = Replyslips::where('scholar_id', $scholarId)->get(); // Filter by scholar_id

            $replyslipstatusid =
                Replyslips::where('scholar_id', $scholarId)->value('replyslip_status_id'); // Filter by scholar_id
            $replyslipsignature = Replyslips::where('scholar_id', $scholarId)->value('signature');
            $replyslipparentsignature = Replyslips::where('scholar_id', $scholarId)->value('signatureparents');
            $reason1 = Replyslips::where('scholar_id', $scholarId)->value('reason');
            //echo $replyslipstatusid;
            // $replyslipparentsignature1 =   . $replyslipparentsignature;
            // dd($replyslipparentsignature1);
            return view(
                'student.replyslipview',
                compact(
                    'studentuser',
                    'replyslips',
                    'programname',
                    'replyslipstatusid',
                    'replyslipsignature',
                    'replyslipparentsignature',
                    'reason1'
                )
            );
        } else {
            // Handle the case where the authenticated user's ID doesn't have a matching scholar_id
            return view('student.replyslipview');
        }
    }

    public function viewsubmittedgrade()
    {
        $userId = auth()->id();
        $studentuser = Student::where('id', $userId)->first();
        $scholarId = $studentuser->scholar_id;

        $cogs = DB::table('cogs')
            ->join('cogdetails', 'cogs.id', '=', 'cogdetails.cog_id')
            ->where('cogs.scholar_id', $scholarId)

            ->select(
                'cogs.startyear',
                'cogs.semester',
                DB::raw('GROUP_CONCAT(cogdetails.id) AS id'),
                DB::raw('GROUP_CONCAT(cogdetails.subjectname) AS Subjectname'),
                DB::raw('GROUP_CONCAT(cogdetails.grade) AS Grade'),
                DB::raw('GROUP_CONCAT(cogdetails.unit) AS Units'),
                DB::raw('GROUP_CONCAT(cogdetails.completed) AS Completed') // Include the completed column
            )
            ->groupBy('cogs.startyear', 'cogs.semester')
            ->where('cogs.draft', '=', 0)
            ->get();




        return view('student.viewsubmittedgrade', compact('cogs'));
    }

    public function viewdraftgrade()
    {
    }

    public function requestclearanceview()
    {
        return view('student.requestclearance');
    }

    public function gradeinputview()
    {
        $userId = auth()->id();
        $studentuser = Student::where('id', $userId)->first();
        $scholarId = $studentuser->scholar_id;

        $cogsdraft = DB::table('cogs')
            ->join('cogdetails', 'cogs.id', '=', 'cogdetails.cog_id')
            ->where('cogs.scholar_id', $scholarId)
            ->where('cogs.draft', '=', 1)
            ->select(
                'cogs.scholar_id',
                'cogs.startyear',
                'cogs.semester',
                'cogs.cog_name',
                DB::raw('GROUP_CONCAT(cogs.id) AS id1'),
                DB::raw('GROUP_CONCAT(cogdetails.id) AS id'),
                DB::raw('GROUP_CONCAT(cogdetails.subjectname) AS Subjectname'),
                DB::raw('GROUP_CONCAT(cogdetails.grade) AS Grade'),
                DB::raw('GROUP_CONCAT(cogdetails.unit) AS Units'),
                DB::raw('GROUP_CONCAT(cogdetails.completed) AS Completed'), // Include the completed column
            )
            ->groupBy('cogs.startyear', 'cogs.semester', 'cogs.cog_name', 'cogs.scholar_id',)
            ->get();

        return view('student.gradeinput', compact('scholarId', 'cogsdraft'));
    }

    public function downloadpdfclearance($filename)
    {

        $file_path = public_path('storage/documents/' . $filename);
        return response()->download($file_path);
    }

    public function studenteditcog(Request $request)
    {
        $cogId = $request->input('cog_id');
        $gradeinput = $request->input('grade');

        // First, retrieve the record
        $record = Cogdetails::where('id', $cogId)->first();
        // Check if the record exists
        if ($record) {
            // Update the grade field
            $record->grade = $gradeinput;
            $result = $record->save();

            if ($result) {
                return back()->with('success', 'Grade Updated successfully');
            } else {
                return back()->with('error', 'Update failed');
            }
        } else {
            // Handle the case where the record with the given ID is not found
            return back()->with('error', 'Cog details not found', 404);
        }
    }



    public function savepdfclearance(Request $request)
    {
        $userId = auth()->id();
        $studentuserid = Student::where('id', $userId)->first();
        $scholarId = $studentuserid->scholar_id;
        $studentuserdetails = Sei::where('id', $scholarId)->first();
        $scholarlname = $studentuserdetails->lname;
        $RequestdocsId = Requestdocs::where('scholar_id', $scholarId)->first();
        $filenameinput = $request->input('fileuploadedname');

        if ($request->hasFile('fileupload')) {
            $file = $request->file('fileupload');
            $filename = time() . $scholarlname . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/documents'), $filename);


            if ($RequestdocsId) {
                // Update the existing record
                $RequestdocsId->update([
                    'document_details' => 'storage/documents/' . $filename,
                    'document' => $request->input('fileuploadedname'),
                ]);
                notyf()
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->duration(2000) // 2 seconds
                    ->addSuccess('Clearance has been uploaded');
            } else {
                // Insert a new record
                Requestdocs::create(
                    // 'document_details' => 'storage/documents' . $filename,
                    // 'document' => $request->input('fileuploadedname'),
                    ['scholar_id' => $scholarId],
                    ['document_details' => 'storage/documents/' . $filename],
                    ['document' => $request->input('fileuploadedname')]
                );

                notyf()
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->duration(2000) // 2 seconds
                    ->addSuccess('Clearance has been uploaded');
            }


            return back();
        } else {
            return response()->json(['error' => 'File not uploaded.']);
        }
    }
}
