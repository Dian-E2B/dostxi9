<?php

namespace App\Http\Livewire\Scholar;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
    public $account;


    public function mount()
    {
        $this->scholar_id = Auth::user()->scholar_id;
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

    public function rules()
    {
        return [
            'account' => 'mimes:pdf',
        ];
    }

    public function save()
    {
        $validatedData = $this->validate();
        $this->account->store('account');
        dd($validatedData);
        /*  dd($this->account); */
        /*  Log::info($this->account); */
        /*   $this->validate([
            'account' => 'mimes:pdf',
        ]); */
        /*  $this->alert('info', 'KO', [
            'position' => 'top  '
        ]); */
        /*  sleep(2); // added this line */
        /*  dd('Form submitted'); */
        /*  session()->flash('success', 'Form submitted successfully!'); */

        // if (isset($this->account)) {

        /*   */
        //     $accountname = $this->scholar_id . 'accnumber' . time() . '.' . $this->account->getClientOriginalExtension();
        //     $storeaccountname =  $this->account->storeAs('public/documents', $accountname);
        //     if ($storeaccountname) {
        //         $updateaccname = DB::table('accnumber')
        //             ->where('scholar_id', $this->scholar_id)
        //             ->update([
        //                 'accnumber_name' => 'storage/accnumber/' . $accountname,
        //                 'status' => 0
        //             ]);

        //         if ($updateaccname) {
        //             $this->alert('info', 'Account Number submitted', [
        //                 'position' => 'top  '
        //             ]);
        //         }
        //     }
        // }

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
