<?php

namespace App\Http\Controllers;

use App\Models\Replyslips;
use App\Models\Sei;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    //
    public function index()
    {

        $userId = auth()->id();
        $studentuser = Student::where('id', $userId)->first();
        $scholarId = $studentuser->scholar_id;

        $scholarstatusid = Sei::where('id', $scholarId)->value('scholar_status_id'); //show status id
        $scholarfullinfo = Sei::where('id', $scholarId)->select('fname', 'mname', 'lname', 'mobile', 'program_id', 'email', 'barangay', 'province', 'municipality', 'zipcode', 'gender_id', 'course', 'school')->first(); //show fullname

        $replyslips = Replyslips::where('scholar_id', $scholarId)->get();
        $replyslipstatus = Replyslips::where('scholar_id', $scholarId)->value('replyslip_status_id');

        return view('student.profile', compact('scholarId', 'replyslips', 'replyslipstatus', 'scholarstatusid', 'scholarfullinfo')); //DASHBOARD VIEW
    }
}
