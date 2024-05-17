<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ongoinglistendorseds;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EndorsedOngoing extends DataTableComponent
{
    use LivewireAlert;
    protected $model = Ongoinglistendorseds::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFiltersStatus(true);
        /*  $this->setFilterLayoutSlideDown(); */
        $this->setFiltersVisibilityStatus(true);
        $this->setFilterLayoutPopover();
        $this->setColumnSelectEnabled();
        $this->setBulkActionsStatus(true); // Enable bulk actions
        $this->setPaginationEnabled();
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setPerPage(100);
    }

    public function filters(): array
    {
        $schools = Ongoinglistendorseds::select('school')->distinct()->pluck('school', 'school')->toArray();

        return [
            SelectFilter::make('School')
                ->options(['' => 'All'] + $schools)
                ->filter(function (Builder $builder, string $value) {
                    if ($value !== '') {
                        $builder->where('Ongoinglistendorseds.school', 'like', '%' . $value . '%');
                    }
                }),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'endorseSelected' => 'Export to Word',
        ];
    }

    public function endorseSelected()
    {

        $selectedIds = $this->getSelected();

        foreach ($selectedIds as $id) {

            $record = Ongoinglistendorseds::find($id);
            /*  if ($record) {
                // Perform your endorsement logic here, for example:
                $record->status_endorsement = 'endorsed'; // or whatever field and value you need
                $record->save();
            } */


            $this->alert('success',  $record->name);
        }

        $this->alert('success', 'Endorsed Approved!');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", 'id'),
            Column::make('Name')
                ->searchable(),
            Column::make('School')
                ->searchable()
        ];
    }
}
