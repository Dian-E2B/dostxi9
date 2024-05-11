<?php

namespace App\Http\Livewire\Scholar;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Thisscholarrequirement extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $scholar_id;
    protected $getaccnumber;
    /*  private $getcor;
    private $getProspectus;
    private $getSO;
    private $getIS;
    private $getSA; */
    protected $setaccnumber;


    public function mount($scholar_id)
    {
        $this->$scholar_id = $scholar_id;
    }

    public function LoadAccnumber()
    {
        $this->getaccnumber = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->select('accnumber_name', 'ac_remarks', 'ac_status')
            ->first();
    }

    /* public function LoadCOR()
    {
        $this->getcor = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->select('cor_name', 'cor1_remarks', 'cor_status')
            ->first();
    }

    public function LoadProspectus()
    {
        $this->getProspectus = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->select('prospectus_name', 'p_remarks', 'p_status')
            ->first();
    }


    public function LoadSO()
    {
        $this->getSO = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->select('scholaroath_name', 'so_remarks', 'so_status')
            ->first();
    }

    public function LoadIS()
    {
        $this->getIS = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->select('infosheet_name', 'inf_remarks', 'inf_status')
            ->first();
    }

    public function LoadSA()
    {
        $this->getSA = DB::table('scholar_requirement_view')
            ->where('scholar_id', $this->scholar_id)
            ->select('scholarshipagreement_name', 'sa_remarks', 'sa_status')
            ->first();
    } */


    public function submitReqUploads()
    {


        $this->alert('info', 'KO', [
            'position' => 'top  '
        ]);
        /*  sleep(2); // added this line */
        /*  dd('Form submitted'); */
        /*  session()->flash('success', 'Form submitted successfully!'); */
        /*   $this->validate([
            'setaccnumber' => 'file|max:1024',
        ]);
 */

        /* if (!null($this->setaccnumber)) {
            $accnumber = $this->scholar_id . 'accnumber' . time() . '.' . $this->setaccnumber->getClientOriginalExtension();
            $storeaccnumber = $this->setaccnumber->file('scholarshipagreement')->storeAs('public/documents', $accnumber);
            DB::table('accnumber')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'accnumber_name' => $this->setaccnumber,
                    'status' => 0
                ]);
        } */

        /*  if (!null($this->setcor)) {
            DB::table('cor_firstreq')
                ->where('scholar_id', $this->scholarId)
                ->update([
                    'remarks' => $this->corremarks,
                    'status' => 2
                ]);
        } */
    }

    public function render()
    {
        $this->LoadAccnumber();
        /* $this->LoadSA();
        $this->LoadIS();
        $this->LoadSO();
        $this->LoadProspectus();

        $this->LoadCOR(); */

        return view(
            'livewire.scholar.thisscholarrequirement',
            [
                'getaccnumber' => $this->getaccnumber,
                /* 'getcor' => $this->getcor,
                'getProspectus' => $this->getProspectus,
                'getSO' => $this->getSO,
                'getIS' => $this->getIS,
                'getSA' => $this->getSA, */
            ]
        );
    }
}
