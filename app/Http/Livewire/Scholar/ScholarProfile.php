<?php

namespace App\Http\Livewire\Scholar;

use Illuminate\Support\Facades\Auth;
use League\Flysystem\MountManager;
use Livewire\Component;

class ScholarProfile extends Component
{
    protected $scholar_id;

    public function mount($scholar_id)
    {
        $this->scholar_id = Auth::user()->scholar_id;
    }
    public function render()
    {
        return view('livewire.scholar.scholar-profile')->extends('student.layouts.app');
    }
}
