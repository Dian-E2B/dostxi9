<?php

namespace App\Http\Livewire;

use App\Models\ongoinglistendorseds;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class AllEndorsedView extends Component
{
    public $years;

    public function mount($years = null)
    {
        $this->years = $years ?? Ongoinglistendorseds::select('year')->distinct()->pluck('year', 'year')->toArray();
    }

    public function render()
    {
        Debugbar::info($this->years);
        return view('livewire.all-endorsed-view');
    }
}
