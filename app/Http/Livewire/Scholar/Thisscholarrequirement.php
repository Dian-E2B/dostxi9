<?php

namespace App\Http\Livewire\Scholar;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Thisscholarrequirement extends Component
{
    public $scholar_id;
    private $getaccnumber;
    private $getcor;
    private $getProspectus;
    private $getSO;
    private $getIS;
    private $getSA;
    public $setaccnumber;
    public $setcor;

    public function mount($scholar_id)
    {
        $this->$scholar_id = $scholar_id;
    }

    public function LoadAccnumber()
    {
        $this->getaccnumber = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->where('ac_status', 2)
            ->select('accnumber_name', 'ac_remarks', 'ac_status')
            ->first();
    }

    public function LoadCOR()
    {
        $this->getcor = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->where('cor_status', 2)
            ->select('cor_name', 'cor1_remarks', 'cor_status')
            ->first();
    }

    public function LoadProspectus()
    {
        $this->getProspectus = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->where('p_status', 2)
            ->select('prospectus_name', 'p_remarks', 'p_status')
            ->first();
    }


    public function LoadSO()
    {
        $this->getSO = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->where('so_status', 2)
            ->select('scholaroath_name', 'so_remarks', 'so_status')
            ->first();
    }

    public function LoadIS()
    {
        $this->getIS = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->where('inf_status', 2)
            ->select('infosheet_name', 'inf_remarks', 'inf_status')
            ->first();
    }

    public function LoadSA()
    {
        $this->getSA = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->where('sa_status', 2)
            ->select('scholarshipagreement_name', 'sa_remarks', 'sa_status')
            ->first();
    }

    public function submitReqUploads()
    {
        if (!null($this->setaccnumber)) {
            DB::table('accnumber')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'remarks' => $this->corremarks,
                    'status' => 2
                ]);
        }

        if (!null($this->setcor)) {
            DB::table('cor_firstreq')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'remarks' => $this->corremarks,
                    'status' => 2
                ]);
        }
    }

    public function render()
    {
        $this->LoadSA();
        $this->LoadIS();
        $this->LoadSO();
        $this->LoadProspectus();
        $this->LoadAccnumber();
        $this->LoadCOR();


        return view(
            'livewire.scholar.thisscholarrequirement',
            [
                'getaccnumber' => $this->getaccnumber,
                'getcor' => $this->getcor,
                'getProspectus' => $this->getProspectus,
                'getSO' => $this->getSO,
                'getIS' => $this->getIS,
                'getSA' => $this->getSA,
            ]
        );
    }
}
