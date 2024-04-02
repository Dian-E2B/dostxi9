<?php

namespace App\Http\Controllers;

use App\Models\Cog;
use App\Models\Cogdetails;
use App\Models\Notification_schols;
use App\Models\Notification_staffs;
use App\Models\Program;
use App\Models\Replyslips;
use App\Models\Requestdocs;
use App\Models\Scholar_requirements;
use App\Models\Scholars;
use App\Models\Sei;
use App\Models\Student;
use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;

class StudentViewController extends Controller
{

    public function thesissubmitreupload(Request $request)
    {

        $request->validate([
            'thesispdf_reupload' => 'required|file|max:10240',
            'thesis_id' => 'required',
        ]);

        $thesisid = $request->input('thesis_id');
        $Thesis = Thesis::find($thesisid);
        $thesisFilePdf = $request->file('thesispdf_reupload');

        $customstudentthesis = Auth::user()->scholar_id . 'thesis' . time() . '.' . $thesisFilePdf->getClientOriginalExtension();
        $request->file('thesispdf_reupload')->storeAs('public/thesis', $customstudentthesis);


        if ($Thesis) {
            $thesisFilePath = $Thesis['thesis_details'];
            $storageDirectoryThesis = 'storage/thesis/';
            $thesisFileName = str_replace($storageDirectoryThesis, '', $thesisFilePath);

            if ($thesisFilePath && Storage::disk('public')->exists('thesis/' . $thesisFileName)) {
                if (Storage::disk('public')->delete('thesis/' . $thesisFileName)) {  //na delete?
                    $Thesis->thesis_details = $storageDirectoryThesis . $customstudentthesis;
                    $Thesis->thesis_status = 'pending';
                    $Thesis->updated_at = now();
                    $Thesis->created_at = now();
                    Notification_staffs::create([ //THEN CREATE NAPUD :(
                        'scholar_id' => Auth::user()->scholar_id,
                        'type' => 'Thesis',
                        'message' => 'An Updated Thesis proposal has been Uploaded',
                        'data_id' => $thesisid,
                    ]);
                    if (!$Thesis->save()) {
                        echo 'Wa na save';
                    } else {
                        return redirect()->route('student/thesis');
                    }
                } else {
                    echo 'wa kita ang id';
                }
            } else {
                echo 'wa na delete';
            }
        } else {
            echo 'wa na kita';
        }
    }

    public function reuploadcogcor(Request $request)
    {
        $cogid = $request->input('cogiddisapprove');
        $cog = Cog::find($cogid); //KUHAA NAME COG AND COR

        $customstudentscorname = Auth::user()->scholar_id . 'cor' . time() . '.' . $request->file('reuploadedcor')->getClientOriginalExtension();
        $request->file('reuploadedcor')->storeAs('public/cor', $customstudentscorname);

        $customstudentscogname = Auth::user()->scholar_id . 'cog' . time() . '.' . $request->file('reuploadedcog')->getClientOriginalExtension();
        $request->file('reuploadedcog')->storeAs('public/cog', $customstudentscogname);

        if ($cog) {
            $cogFilePath = $cog['cog_name'];
            $corFilePath = $cog['cor_name'];
            $storageDirectoryCog = 'storage/cog/';
            $storageDirectoryCor = 'storage/cor/';
            $cogFileName = str_replace($storageDirectoryCog, '', $cogFilePath);
            $corFileName = str_replace($storageDirectoryCor, '', $corFilePath);
            if ($cogFilePath && Storage::disk('public')->exists('cog/' . $cogFileName)) {
                $cogdelete = Storage::disk('public')->delete('cog/' . $cogFileName);
                $cordelete =   Storage::disk('public')->delete('cor/' . $corFileName);

                if ($cogdelete && $cordelete) {
                    $cog->cor_name = 'storage/cor/' . $customstudentscorname;
                    $cog->cog_name = 'storage/cog/' . $customstudentscogname;
                    $cog->cogcor_status = null;
                    $cog->cogcor_remarks = null;
                    $corsave = $cog->save();
                    if ($corsave) {
                        Notification_schols::where('data_id', $cogid)->delete(); //DELETE THAT SHIT
                        Notification_staffs::create([ //THEN CREATE NAPUD :(
                            'scholar_id' => Auth::user()->scholar_id,
                            'type' => 'COR and COG',
                            'message' => 'An Updated COR and COG has been Uploaded',
                            'data_id' => $cogid,
                        ]);
                        return redirect()->back()->with('success', 'Files reuploaded successfully. Thank you!');
                    }
                }
            }
        }
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

        $cogdisapproved = Cog::where('scholar_id', $scholarId)
            ->where('cogcor_status', "disapproved")
            ->get();

        return view('student.gradeinput', compact('scholarId', 'cogsdraft', 'cogdisapproved'));
    }

    public function endaccess()
    {
        if (Auth::check()) {
            $scholarId = Auth::user()->scholar_id;
            $seis = Student::where('scholar_id', $scholarId)->first();
            if ($seis) {
                if ($seis->delete()) {
                    Auth::logout();
                    $seis2 = Sei::find($scholarId);
                    if ($seis2) {
                        $seis2->scholar_status_id = 7;
                        $seis2->save();
                    }
                    return redirect()->route('student.login');
                } else {
                    // Deletion failed
                    echo 'Failed to delete account.';
                }
            } else {
                // User not found
                echo 'User not found.';
            }
        } else {
            // User not authenticated
            echo 'User not authenticated.';
        }
    }

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
                return redirect('student/profile');
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
        $request->file('corname')->storeAs('public/cor', $customcorname); //store file name cor

        $customcogname = $scholarid . 'cogname' . time() . '.' . $request->file('cogname')->getClientOriginalExtension(); //put custom filename cog
        $request->file('cogname')->storeAs('public/cog', $customcogname); //store file name for cog

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

            $replyslips = Replyslips::where('scholar_id', $scholarId)->get(); // Filter by scholar_id

            $replyslipstatusid =
                Replyslips::where('scholar_id', $scholarId)->value('replyslip_status_id'); // Filter by scholar_id
            $replyslipsignature = Replyslips::where('scholar_id', $scholarId)->value('signature');
            $replyslipparentsignature = Replyslips::where('scholar_id', $scholarId)->value('signatureparents');
            $reason1 = Replyslips::where('scholar_id', $scholarId)->value('reason');
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
                return back()->with('errors', 'Update failed');
            }
        } else {
            // Handle the case where the record with the given ID is not found
            return back()->with('errors', 'Cog details not found', 404);
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
                /*  notyf()
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->duration(2000) // 2 seconds
                    ->addSuccess('Clearance has been uploaded'); */
            } else {
                // Insert a new record
                Requestdocs::create(
                    // 'document_details' => 'storage/documents' . $filename,
                    // 'document' => $request->input('fileuploadedname'),
                    ['scholar_id' => $scholarId],
                    ['document_details' => 'storage/documents/' . $filename],
                    ['document' => $request->input('fileuploadedname')]
                );

                /*  notyf()
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->duration(2000) // 2 seconds
                    ->addSuccess('Clearance has been uploaded'); */
            }


            return back();
        } else {
            return response()->json(['errors' => 'File not uploaded.']);
        }
    }
}
