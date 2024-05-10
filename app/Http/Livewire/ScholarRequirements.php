<?php

namespace App\Http\Livewire;

use Flasher\Prime\FlasherInterface;
use Livewire\Attributes\On;
use App\Models\Cog;
use App\Models\Notification_schols;
use App\Models\Thesis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ScholarRequirements extends Component
{
    use LivewireAlert;
    public $databaseValues;
    public $scholarId;
    private  $scholarrequirements;
    public $cogpassed;
    /* public $decision; */
    public $accnumstatus;
    public $accremarks;
    public $corremarks;
    public $corstatus;
    public $soStatus;
    public $soRemarks;
    public $prosRemarks;
    public $prosStatus;
    public $ISStatus;
    public $ISRemarks;
    public $SAStatus;
    public $SARemarks;
    public $SOStatus;
    public $SORemarks;

    public function mount($scholarId)
    {
        $this->scholarId = $scholarId;
    }

    public function submitacc($decision)
    {
        $getaccdata_id = DB::table('accnumber')
            ->where('scholar_id', $this->scholarId)
            ->value('id');

        if ($decision == "no") {
            DB::table('accnumber')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'remarks' => $this->accremarks,
                    'status' => 2
                ]);
            Notification_schols::create( //add notif to scholar
                [
                    'type' => 'Accnumber',
                    'message' => 'Your Account Number has been disapproved. Please see remarks for details.',
                    'data_id' =>  $getaccdata_id,
                    'scholar_id' => $this->scholarId,
                ]
            );
            $this->alert('info', 'Accnumber Disapproved', [
                'position' => 'top  '
            ]);
        } else {
            DB::table('accnumber')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'status' => 1
                ]);
            $this->alert('success', 'Accnumber Approved!', [
                'position' => 'top  '
            ]);
        }
    }

    public function submitcor($decision)
    {
        $getcordata_id = DB::table('cor_firstreq')
            ->where('scholar_id', $this->scholarId)
            ->value('id');

        if ($decision == "no") {
            DB::table('cor_firstreq')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'remarks' => $this->corremarks,
                    'status' => 2
                ]);
            Notification_schols::create( //add notif to scholar
                [
                    'type' => 'COR',
                    'message' => 'Your COR has been disapproved. Please see remarks for details.',
                    'data_id' =>  $getcordata_id,
                    'scholar_id' => $this->scholarId,
                ]
            );
            $this->alert('info', 'COR Disapproved!');
        } else {
            DB::table('cor_firstreq')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'status' => 1
                ]);
            $this->alert('success', 'COR Approved!');
        }
    }

    public function submitSO($decision)
    {
        $getsodata_id = DB::table('scholaroath')
            ->where('scholar_id', $this->scholarId)
            ->value('id');

        if ($decision == "no") {
            DB::table('scholaroath')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'remarks' => $this->SORemarks,
                    'status' => 2
                ]);
            Notification_schols::create( //add notif to scholar
                [
                    'type' => 'Scholar\'s Oath',
                    'message' => 'Your Scholar\'s Oath has been disapproved. Please see remarks for details.',
                    'data_id' =>  $getsodata_id,
                    'scholar_id' => $this->scholarId,
                ]
            );
            $this->alert('info', 'Scholar Oath Disapproved!');
        } else {
            DB::table('scholaroath')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'status' => 1
                ]);
            $this->alert('success', 'Scholar Oath  Approved!');
        }
    }


    public function submitpros($decision)
    {
        $getprosdata_id = DB::table('prospectus')
            ->where('scholar_id', $this->scholarId)
            ->value('id');

        if ($decision == "no") {
            DB::table('prospectus')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'remarks' => $this->prosRemarks,
                    'status' => 2
                ]);
            Notification_schols::create( //add notif to scholar
                [
                    'type' => 'Prospectus',
                    'message' => 'Your Prospectus has been disapproved. Please see remarks for details.',
                    'data_id' =>  $getprosdata_id,
                    'scholar_id' => $this->scholarId,
                ]
            );
            $this->alert('info', 'Prospectus Disapproved!');
        } else {
            DB::table('prospectus')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'status' => 1
                ]);
            $this->alert('success', 'Prospectus Approved!');
        }
    }

    public function submitIS($decision)
    {
        $getisdata_id = DB::table('informationsheet')
            ->where('scholar_id', $this->scholarId)
            ->value('id');

        if ($decision == "no") {
            DB::table('informationsheet')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'remarks' => $this->ISRemarks,
                    'status' => 2
                ]);
            Notification_schols::create( //add notif to scholar
                [
                    'type' => 'Information Sheet',
                    'message' => 'Your Information Sheet has been disapproved. Please see remarks for details.',
                    'data_id' =>  $getisdata_id,
                    'scholar_id' => $this->scholarId,
                ]
            );
            $this->alert('info', 'Information Sheet Disapproved!');
        } else {
            DB::table('informationsheet')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'status' => 1
                ]);
            $this->alert('success', 'Information Sheet Approved!');
        }
    }

    public function submitSA($decision)
    {
        $getsadata_id = DB::table('scholarshipagreement')
            ->where('scholar_id', $this->scholarId)
            ->value('id');

        if ($decision == "no") {
            DB::table('scholarshipagreement')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'remarks' => $this->SARemarks,
                    'status' => 2
                ]);
            Notification_schols::create( //add notif to scholar
                [
                    'type' => 'Scholar Agreement',
                    'message' => 'Your Scholar Agreement has been disapproved. Please see remarks for details.',
                    'data_id' =>  $getsadata_id,
                    'scholar_id' => $this->scholarId,
                ]
            );
            $this->alert('info', 'Scholarship Agreement Disapproved!');
        } else {
            DB::table('scholarshipagreement')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'status' => 1
                ]);
            $this->alert('success', 'Scholarship Agreement Approved!');
        }
    }

    public function checkSA()
    {
        $this->SAStatus = DB::table('scholarshipagreement')
            ->where('scholar_id', $this->scholarId)
            ->value('status');
    }

    public function checkSO()
    {
        $this->SOStatus = DB::table('scholaroath')
            ->where('scholar_id', $this->scholarId)
            ->value('status');
    }

    public function checkIS()
    {
        $this->ISStatus = DB::table('informationsheet')
            ->where('scholar_id', $this->scholarId)
            ->value('status');
    }

    public function checkpros()
    {
        $this->prosStatus = DB::table('prospectus')
            ->where('scholar_id', $this->scholarId)
            ->value('status');
    }

    public function checkaccNumber()
    {
        $this->accnumstatus = DB::table('accnumber')
            ->where('scholar_id', $this->scholarId)
            ->value('status');
    }

    public function checkCor()
    {
        $this->corstatus = DB::table('cor_firstreq')
            ->where('scholar_id', $this->scholarId)
            ->value('status');
    }

    public function checkScholarAgreement()
    {
        $this->saStatus = DB::table('scholaroath')
            ->where('scholar_id', $this->scholarId)
            ->value('status');
    }


    public function LoadThesis()
    {
        $this->databaseValues = Thesis::where('scholar_id', $this->scholarId)->get();
    }

    public function LoadScholar()
    {
        $this->scholarrequirements = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholarId)
            ->first();
    }

    public function LoadCog()
    {
        $this->cogpassed = Cog::where('scholar_id', $this->scholarId)->get();
    }

    public function render()
    {
        $this->checkSA();
        $this->checkSO();
        $this->checkIS();
        $this->checkpros();
        $this->checkScholarAgreement();
        $this->checkCor();
        $this->checkaccNumber();
        $this->LoadThesis();
        $this->LoadScholar();
        $this->LoadCog();
        return view('livewire.scholar-requirements', [
            'scholarrequirements' => $this->scholarrequirements,
        ]);
    }
}
