<?php

namespace App\Services;

use App\Models\Ongoing;
use App\Models\Ongoinglist_endorsed;
use App\Models\Replyslips;
use App\Models\Sei;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class MainServices
{
    // Your service methods will go here

    public function enrollscholartoongoing($id, $semester, $startyear)
    {
        $seisourcerecord = Sei::find($id);

        if ($seisourcerecord) {

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

            $latestRecord = Ongoing::where('NUMBER', $seisourcerecord->scholar_id)
                ->orderByDesc('created_at')
                ->first();


            //ASSUMING 2024 ANG STARTYEAR
            if ($semester == 1) { //2
                $semestralAverage = DB::table('cogs as c')
                    ->leftJoin('cogdetails as cd', 'cd.cog_id', '=', 'c.id')
                    ->select(DB::raw('ROUND((SUM(cd.unit * cd.grade) / NULLIF(SUM(cd.unit), 0)), 2) as semestral_average'))
                    ->where('c.startyear', $startyear - 1) //2023?
                    ->where('c.semester', $semester + 1) //so 2nd sem?
                    ->first();
            } elseif ($semester == 2) { //2nd sem

                $semestralAverage = DB::table('cogs as c')
                    ->leftJoin('cogdetails as cd', 'cd.cog_id', '=', 'c.id')
                    ->select(DB::raw('ROUND((SUM(cd.unit * cd.grade) / NULLIF(SUM(cd.unit), 0)), 2) as semestral_average'))
                    ->where('c.startyear', $startyear) //2024?
                    ->where('c.semester', $semester - 1) //so 1st sem?
                    ->first();
            } else { //if summer
                $semestralAverage = DB::table('cogs as c')
                    ->leftJoin('cogdetails as cd', 'cd.cog_id', '=', 'c.id')
                    ->select(DB::raw('ROUND((SUM(cd.unit * cd.grade) / NULLIF(SUM(cd.unit), 0)), 2) as semestral_average'))
                    ->where('c.startyear', $startyear - 1) // Assuming 2023
                    ->where('c.semester', $semester + 2) // Average for the next semester
                    ->first();
            }


            if ($semestralAverage === null) {
                $semestralAverageValue = "";
            } else {
                $semestralAverageValue = number_format(floatval($semestralAverage->semestral_average ?? ""), 2);
            }



            if ($latestRecord) {
                $destinationRecord = new Ongoing();
                $destinationRecord->BATCH = $yearValue;
                $destinationRecord->NUMBER = $seisourcerecord->id;
                $destinationRecord->NAME = $seisourcerecord->lname . ", " . $seisourcerecord->fname . " " . $seisourcerecord->mname;
                $destinationRecord->MF =  $genderValue;
                $destinationRecord->SCHOLARSHIPPROGRAM = $program_id;
                $destinationRecord->SCHOOL = $seisourcerecord->school;
                $destinationRecord->COURSE =  $seisourcerecord->course;
                $destinationRecord->STATUSENDORSEMENT2 = "";
                $destinationRecord->GRADES = $semestralAverageValue; //semi automatic lol
                $destinationRecord->SummerREG = $latestRecord->SummerREG; //MANUAL
                $destinationRecord->REGFORMS = $latestRecord->REGFORMS; //MANUAL
                $destinationRecord->REMARKS = $latestRecord->REMARKS;
                $destinationRecord->STATUSENDORSEMENT = $latestRecord->STATUSENDORSEMENT2;
                $destinationRecord->NOTATIONS = $latestRecord->NOTATIONS;
                $destinationRecord->SUMMER = $latestRecord->SUMMER;
                $destinationRecord->FARELEASEDTUITION = $latestRecord->FARELEASEDTUITION;
                $destinationRecord->FARELEASEDTUITIONBOOKSTIPEND = $latestRecord->FARELEASEDTUITIONBOOKSTIPEND;
                $destinationRecord->LVDCAccount = $latestRecord->LVDCAccount;
                $destinationRecord->HVCNotes = $latestRecord->LVDCAccount;
                $destinationRecord->startyear =  $startyear;
                $destinationRecord->endyear = $startyear + 1;
                $destinationRecord->semester = $semester;
                $destinationRecord->created_at = now();
                $destinationRecord->save();


                /*  $endorsedRecord = new Ongoinglist_endorsed();
                $endorsedRecord->scholar_id =  $seisourcerecord->id;
                $endorsedRecord->name =  $seisourcerecord->lname . ", " . $seisourcerecord->fname . " " . $seisourcerecord->mname;
                $endorsedRecord->school = $seisourcerecord->school;
                $endorsedRecord->course = $seisourcerecord->course;
                $endorsedRecord->save(); */
            } else {
                $destinationRecord = new Ongoing();
                $destinationRecord->BATCH = $yearValue;
                $destinationRecord->NUMBER = $seisourcerecord->id;
                $destinationRecord->NAME = $seisourcerecord->lname . ", " . $seisourcerecord->fname . " " . $seisourcerecord->mname;
                $destinationRecord->MF =  $genderValue;
                $destinationRecord->SCHOLARSHIPPROGRAM = $program_id;
                $destinationRecord->SCHOOL = $seisourcerecord->school;
                $destinationRecord->COURSE =  $seisourcerecord->course;
                $destinationRecord->STATUSENDORSEMENT2 = "";
                $destinationRecord->GRADES = $semestralAverageValue; //semi automatic lol
                $destinationRecord->SummerREG = ""; //MANUAL
                $destinationRecord->REGFORMS = ""; //MANUAL
                $destinationRecord->REMARKS = "";
                $destinationRecord->STATUSENDORSEMENT = "";
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

                /*  $endorsedRecord = new Ongoinglist_endorsed();
                $endorsedRecord->scholar_id =  $seisourcerecord->id;
                $endorsedRecord->name =  $seisourcerecord->lname . ", " . $seisourcerecord->fname . " " . $seisourcerecord->mname;
                $endorsedRecord->school = $seisourcerecord->school;
                $endorsedRecord->course = $seisourcerecord->course;
                $endorsedRecord->save(); */
            }

            try {
                if ($destinationRecord) {
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                    Log::info('Session data before redirect:', session()->all());
                    return back()->with('approved', 'COG and COR has been approved scholar is now appended to ongoing!');
                }
            } catch (\Exception $e) {
                if ($e->getCode() == 23000) {
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                } else {
                    echo ('Error in enrollscholartoongoing:' . $e->getMessage());
                }
            }
        } else {
            echo ('WA NAKITA ANG ID');
        }
    }
}
