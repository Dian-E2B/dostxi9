<?php

namespace App\Http\Livewire\Staff;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EndorsedFrom extends Component
{
    use LivewireAlert;


    public $Firstname;
    public $Middlename;
    public $Surname;
    public $Birthdate;
    public $Email;
    public $LVDCaccount;
    public $appid;
    public $program;
    public $gender;
    public $spasno;
    public $mobile;
    public $year;
    public $strand;

    protected $rules = [
        'Firstname' => 'required|string|max:255',
        'Middlename' => 'nullable|string|max:255',
        'Surname' => 'required|string|max:255',
        'Birthdate' => 'required|date',
        'Email' => 'required|email',
        'LVDCaccount' => 'nullable|string|max:255',
        'appid' => 'nullable|string|max:255',
        'program' => 'required', // Add the appropriate validation rule for program selection
        'gender' => 'required', // Add the appropriate validation rule for gender selection
        'spasno' => 'required|string|max:255',
        'mobile' => 'required|numeric', // Numeric validation rule for mobile
        'year' => 'required|string|max:255',
        'strand' => 'required|string|max:255',
    ];


    public function save()
    {
        $this->validate();
        /*  Debugbar::info($this->mobile); */
        $insertdata = DB::table('endorsedfrom_scholars')->insert([
            'fname' => $this->Firstname,
            'mname' => $this->Middlename,
            'lname' => $this->Surname,
            'bday' => $this->Birthdate,
            'email' => $this->Email,
            'LVDCaccount' => $this->LVDCaccount,
            'app_id' => $this->appid,
            'program_id' => $this->program,
            'gender_id' => $this->gender,
            'spasno' => $this->spasno,
            'mobile' => $this->mobile,
            'year' => $this->year,
            'strand' => $this->strand,
            'scholar_status_id' => 1, //ongoing?
            'endorsed_status' => 1,
        ]);

        $insertdata2 = DB::table('seis')->insertGetId([
            'fname' => $this->Firstname,
            'mname' => $this->Middlename,
            'lname' => $this->Surname,
            'bday' => $this->Birthdate,
            'email' => $this->Email,
            'LVDCaccount' => $this->LVDCaccount,
            'app_id' => $this->appid,
            'program_id' => $this->program,
            'gender_id' => $this->gender,
            'spasno' => $this->spasno,
            'mobile' => $this->mobile,
            'year' => $this->year,
            'strand' => $this->strand,
            'scholar_status_id' => 2, //ongoing?
            'endorsed_status' => 1,
        ]);

        $WithoutHyphensbirthday = str_replace('-', '', $this->Birthdate);
        $password101 = Hash::make($WithoutHyphensbirthday);

        $createacc = DB::table('students')->insert([
            'scholar_id' => $insertdata2,
            'email' => $this->Email,
            'username' => $this->Firstname,
            'password' => $password101,
        ]);
        if ($insertdata && $insertdata2 &&  $createacc) {
            $this->alert('success', 'Data saved successfully!');
        }

        $this->emit('closeModal');
        $this->reset();
    }


    public function render()
    {
        $getprogram = DB::table('programs')->get();
        $getgender = DB::table('genders')->get();
        return view('livewire.staff.endorsed-from', [
            'programs' =>  $getprogram,
            'genders' => $getgender,
        ]);
    }
}
