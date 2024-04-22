<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\EmailContent;
use App\Models\Replyslips;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB; // For the DB facade
use App\Models\Scholars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailnotifyawards;
use App\Models\email_merit;
use App\Models\email_ra10612;
use App\Models\email_ra7687;
use App\Models\Sei;

class SendMailController extends Controller
{
    public function index()
    {


        $duplicateEmails = Sei::select('email', \DB::raw('COUNT(*) as count'))
            ->whereNotNull('email')
            ->groupBy('email')
            ->having('count', '>', 1)
            ->get();

        if ($duplicateEmails->isEmpty()) {
            $emailsra7687 = DB::table('seis')
                ->where('program_id', 101)
                ->where('scholar_status_id', 0)
                ->whereNotNull('email')
                ->where('email', '<>', '')
                ->whereNull('lacking')
                ->orWhere('lacking', '')
                ->groupBy('email')
                ->pluck('email')
                ->toArray();

            $emailsmerit = DB::table('seis')
                ->where('program_id', 201)
                ->where('scholar_status_id', 0)
                ->whereNotNull('email')
                ->where('email', '<>', '')
                ->whereNull('lacking')
                ->orWhere('lacking', '')
                ->groupBy('email')
                ->pluck('email')
                ->toArray();

            $emailsra10612 = DB::table('seis')
                ->where('program_id', 301)
                ->where('scholar_status_id', 0)
                ->whereNotNull('email')
                ->where('email', '<>', '')
                ->whereNull('lacking')
                ->orWhere('lacking', '')
                ->groupBy('email')
                ->pluck('email')
                ->toArray();


            $content = EmailContent::first();

            if (!empty($emailsra7687)) {

                foreach ($emailsra7687 as $email2) {

                    $mailData = [
                        'title' => '<h2><span contenteditable="false">Congratulations for qualifying for the ' . date('Y') . ' DOST-SEI S&T Undergraduate Scholarships under <strong style="color: red">RA 7687</strong>.</span></h2> ',
                        'message' => $content->content,
                    ];


                    /* dd($date, $venue, $time); */
                    $sei = Sei::where('email', $email2)->first();
                    $id = $sei->id;
                    $birthday = $sei->bday;
                    $username = $sei->fname;
                    $WithoutHyphensbirthday = str_replace('-', '', $birthday);
                    $password101 = Hash::make($WithoutHyphensbirthday);
                    /*  $password101 = bcrypt($WithoutHyphensbirthday); */

                    try {
                        // Send the email
                        $var = Mail::to($email2)->send(new Mailnotifyawards($mailData));


                        if ($var) {
                            // Update the scholar_status_id to 1 meaning pending
                            Sei::where('id', $id)->update(['scholar_status_id' => 1]);
                        }



                        //PUT ON PENDING ON EMAIL STATUS IF IT EXIST ALREADY, THEN NO NEED TO ADd IT
                        Replyslips::firstOrCreate(
                            ['scholar_id' => $id],
                            ['replyslip_status_id' => 1] // 1 means pending
                        );

                        //ADD or UPDATE TO Student TABLE
                        Student::updateOrCreate(
                            ['scholar_id' => $id],
                            ['email' => $email2, 'password' => $password101, 'username' => $username]
                        );
                    } catch (Exception $e) {
                        // dd($e->getMessage());
                        //do nothing
                        session()->flash('errors', 'ERROR: ' . $e->getMessage());
                        /*   session()->flash('errors', 'No Proper Internet Connection!'); */
                    }
                }
                session()->flash('success', 'Your notice for All RA 7687 has been sent!');
            }


            if (!empty($emailsmerit)) {
                foreach ($emailsmerit as $email) {

                    $mailData = [
                        'title' => '<h2><span contenteditable="false">Congratulations for qualifying for the ' . date('Y') . ' DOST-SEI S&T Undergraduate Scholarships under <strong style="color: red">MERIT</strong>.</span></h2> ',
                        'message' => $content->content,
                    ];

                    $sei = Sei::where('email', $email)->first();
                    $id = $sei->id;
                    $birthday = $sei->bday;
                    $username = $sei->fname;
                    $WithoutHyphensbirthday = str_replace('-', '', $birthday);
                    $password101 = Hash::make($WithoutHyphensbirthday);

                    try {
                        // Send the email
                        Mail::to($email)->send(new Mailnotifyawards($mailData));

                        // Update the scholar_status_id to 1 meaning pending
                        Sei::where('id', $id)->update(['scholar_status_id' => 1]);

                        //PUT ON PENDING ON EMAIL STATUS IF IT EXIST ALREADY, THEN NO NEED TO AD IT
                        Replyslips::firstOrCreate(
                            ['scholar_id' => $id],
                            ['replyslip_status_id' => 1] // 1 means pending
                        );

                        //ADD or UPDATE TO Student TABLE
                        Student::updateOrCreate(
                            ['scholar_id' => $id],
                            ['email' => $email, 'password' => $password101, 'username' => $username]
                        );
                        session()->flash('success', 'Your notice for All Merit has been sent!'); //UPDATED 03/11/2024
                    } catch (Exception $e) {
                        // dd($e->getMessage());
                        session()->flash('error', 'Sorry, an error occurred:' . $e->getMessage());
                    }
                }
            }


            if (!empty($emailsra10612)) {
                foreach ($emailsra10612 as $email) {

                    $mailData = [
                        'title' => '<h2><span contenteditable="false">Congratulations for qualifying for the ' . date('Y') . ' DOST-SEI S&T Undergraduate Scholarships under <strong style="color: red">RA 10612</strong>.</span></h2> ',
                        'message' => $content->content,
                    ];

                    $sei = Sei::where('email', $email)->first();
                    $id = $sei->id;
                    $birthday = $sei->bday;
                    $username = $sei->fname;
                    $WithoutHyphensbirthday = str_replace('-', '', $birthday);


                    $password101 = Hash::make($WithoutHyphensbirthday, [
                        'rounds' => 12,
                    ]);


                    try {
                        // Send the email
                        Mail::to($email)->send(new Mailnotifyawards($mailData));

                        // Update the scholar_status_id to 1 meaning pending
                        Sei::where('id', $id)->update(['scholar_status_id' => 1]);

                        //PUT ON PENDING ON EMAIL STATUS IF IT EXIST ALREADY, THEN NO NEED TO AD IT
                        Replyslips::firstOrCreate(
                            ['scholar_id' => $id],
                            ['replyslip_status_id' => 1] // 1 means pending
                        );

                        //ADD or UPDATE TO Student TABLE
                        Student::updateOrCreate(
                            ['scholar_id' => $id],
                            ['email' => $email, 'password' => $password101, 'username' => $username]
                        );
                    } catch (Exception $e) {
                        // dd($e->getMessage());
                        session()->flash('error', 'Sorry, an error occurred:' . $e->getMessage());
                        //do nothing
                    }
                }
                session()->flash('success', 'Your notice for RA 10612 has been sent!');
            }
        } else {
            session()->flash('error', 'A duplicate email entry in your records. Please Check');
        }

        /* return response()->json($duplicateEmails); */






        return back();
    }
}
