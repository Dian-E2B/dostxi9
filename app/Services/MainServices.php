<?php

namespace App\Services;

use App\Models\Ongoing;
use App\Models\Replyslips;
use App\Models\Sei;
use Illuminate\Support\Facades\Log;

class MainServices
{
    // Your service methods will go here

    public function enrollscholartoongoing($id, $semester, $startyear)
    {
        $seisourcerecord = Sei::find($id);
        // Check if the record exists
        if ($seisourcerecord) {
            // Access the value of the 'year' column
            $yearValue = $seisourcerecord->year;
            $genderValue = $seisourcerecord->gender_id;
            $program_id = $seisourcerecord->program_id;

            if ($genderValue == 1) {
                $genderValue = "F";
            } else {
                $genderValue = "M";
            }

            if ($program_id == 101) {
                $program_id = "RA 7687";
            } elseif ($program_id == 201) {
                $program_id = "MERIT";
            } else {
                $program_id = "RA 10612";
            }

            /*  $currentYear = now()->year; */
            // Create a new record in the destination table
            $destinationRecord = new Ongoing();
            $destinationRecord->BATCH = $yearValue;
            $destinationRecord->NUMBER = $seisourcerecord->id;
            $destinationRecord->NAME = $seisourcerecord->lname . ", " . $seisourcerecord->fname . " " . $seisourcerecord->mname;
            $destinationRecord->MF =  $genderValue;
            $destinationRecord->SCHOLARSHIPPROGRAM = $program_id;
            $destinationRecord->SCHOOL = $seisourcerecord->school;
            $destinationRecord->COURSE =  $seisourcerecord->course;
            $destinationRecord->GRADES = ""; //MANUAL
            $destinationRecord->SummerREG = ""; //MANUAL
            $destinationRecord->REGFORMS = ""; //MANUAL
            $destinationRecord->REMARKS = "";
            $destinationRecord->STATUSENDORSEMENT = "";
            $destinationRecord->STATUSENDORSEMENT2 = "";
            $destinationRecord->STATUSENDORSEMENT2 = "";
            $destinationRecord->NOTATIONS = "";
            $destinationRecord->SUMMER = "";
            $destinationRecord->FARELEASEDTUITION = "";
            $destinationRecord->FARELEASEDTUITIONBOOKSTIPEND = "";
            $destinationRecord->LVDCAccount = "";
            $destinationRecord->HVCNotes = "";
            $destinationRecord->startyear =  $startyear;
            $destinationRecord->endyear = $startyear + 1;
            $destinationRecord->semester = $semester;
            $destinationRecord->created_at = now();
            $destinationRecord->save();
            try {
                if ($destinationRecord) {
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                    Log::info('Session data before redirect:', session()->all());
                    return back()->with('approved', 'COG and COR has been approved scholar is now appended to ongoing!');
                }
            } catch (\Exception $e) {
                // Check if it's a unique constraint violation
                if ($e->getCode() == 23000) {
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                } else {
                    // Handle other database-related exceptions
                    Log::error('Error in enrollscholartoongoing:' . $e->getMessage());
                }
            }
        } else {
            Log::error('WA NAKITA ANG ID');
        }
    }
}
