<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Hash;

class Stafftable extends DataTableComponent
{
    protected $model = User::class;
    use LivewireAlert;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(?string $year = null): EloquentBuilder
    {
        /*    Debugbar::info($this->selectedYear); */
        $query = User::query()
            ->where('role', 'staff');
        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id"),
            Column::make("Role", "role"),
            Column::make("Username", "username"),
            Column::make("Email", "email"),
            Column::make("Created at", "created_at"),
            Column::make("Updated at", "updated_at"),
            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $delete = '<button class="thisbutton btn-sm btn btn-primary" wire:click="delete(' . $row->id . ')">Trash</button>';
                        $edit = '<button data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reset Password" class="thisbutton btn-sm btn btn-warning ms-2" wire:click="edit(' . $row->id . ')"><i class="bi bi-arrow-counterclockwise"></i></button>';
                        return $delete . $edit;
                    }
                )->html(),

        ];
    }


    public function edit($id)
    {
        $resetpassval = 12345678;
        $password101 = Hash::make($resetpassval);
        $finduser = User::find($id);
        if ($finduser) {
            $finduser->password =  $password101;
            $finduser->updated_at =  now();
            $finduser->save();
            $this->alert('success', 'Password Reset to default');
        } else {
            $this->alert('error', 'Password Not Reset!');
        }
    }

    public function delete($id)
    {
        $finduser = User::find($id);
        if ($finduser) {
            $balhinusers = DB::table('lockedusers')->insert([
                'username' =>  $finduser->username,
                'email' =>  $finduser->email,
                'email_verified_at' =>  null,
                'role' =>  $finduser->role,
                'password' =>  null,
                'remember_token' =>  $finduser->remember_token,
                'created_at' =>  now(),
                'updated_at' =>  now(),
            ]);
            if ($balhinusers) {
                $finduser->delete();
                $this->alert('warning', 'User has been Locked');
            }
        } else {
            $this->alert('error', 'Password Not Reset!');
        }
    }
}
