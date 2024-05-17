<?php

namespace App\Http\Livewire\Staff;

use App\Models\Ongoinglist_endorsed;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EndorsedOngoing extends Component
{

   public $semester;
    public $startyear;
    public $thisendorsed;


    public function mount($semester,$startyear) {
        $this->semester = $semester;
        $this->startyear = $startyear;

    }

    public function checkendorsed()
    {
        $this->thisendorsed = DB::table('ongoinglistendorseds')
            ->where('semester', $this->semester)
            ->where('year', $this->startyear)
            ->get();
    }


    public function render()
    {
        $this->checkendorsed();
        return view('livewire.staff.endorsed-ongoing');
    }
}
