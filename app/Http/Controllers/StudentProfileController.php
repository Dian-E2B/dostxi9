<?php

namespace App\Http\Controllers;

use App\Models\Replyslips;
use App\Models\Sei;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
