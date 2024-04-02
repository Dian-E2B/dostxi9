<?php

namespace App\Services;

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

            if ($genderValue == 1) {
                $genderValue = "F";
            } else {
                $genderValue = "M";
            }

            /*  $currentYear = now()->year; */
            // Create a new record in the destination table
            $destinationRecord = new Ongoing();
            $destinationRecord->BATCH = $yearValue;
            $destinationRecord->NUMBER = $seisourcerecord->id;
            $destinationRecord->NAME = $seisourcerecord->lname . ", " . $seisourcerecord->fname . " " . $seisourcerecord->mname;
            $destinationRecord->MF =  $genderValue;
            $destinationRecord->SCHOLARSHIPPROGRAM = null;
            $destinationRecord->SCHOOL = $seisourcerecord->school;
            $destinationRecord->COURSE =  $seisourcerecord->course;
            $destinationRecord->GRADES = null; //MANUAL
            $destinationRecord->SummerREG = null; //MANUAL
            $destinationRecord->REGFORMS = null; //MANUAL
            $destinationRecord->REMARKS = null;
            $destinationRecord->STATUSENDORSEMENT = NULL;
            $destinationRecord->STATUSENDORSEMENT2 = NULL;
            $destinationRecord->STATUSENDORSEMENT2 = NULL;
            $destinationRecord->NOTATIONS = null;
            $destinationRecord->SUMMER = NULL;
            $destinationRecord->FARELEASEDTUITION = NULL;
            $destinationRecord->FARELEASEDTUITIONBOOKSTIPEND = NULL;
            $destinationRecord->LVDCAccount = NULL;
            $destinationRecord->HVCNotes = NULL;
            $destinationRecord->startyear =  $startyear;
            $destinationRecord->endyear = $startyear + 1;
            $destinationRecord->semester = $semester;

            try {
                $destinationRecord->save();
                if ($destinationRecord) {
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                    return redirect()->route('accesscontrolenrolled');
                }
            } catch (\Exception $e) {
                // Check if it's a unique constraint violation
                if ($e->getCode() == 23000) {
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                    return redirect()->route('accesscontrolenrolled')->with('success', 'Your application has been received');
                } else {
                    // Handle other database-related exceptions
                }
            }
        }
    }
}
