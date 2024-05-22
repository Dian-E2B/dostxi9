<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ongoinglistendorseds;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class AllEndorsedOngoing extends DataTableComponent
{
    protected $model = Ongoinglistendorseds::class;


    public $selectedFilters;


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFiltersStatus(true);
        $this->setFiltersVisibilityStatus(true);
        $this->setFilterLayoutPopover();
        $this->setColumnSelectEnabled();
        $this->setBulkActionsStatus(true); // Enable bulk actions
        $this->setPaginationEnabled();
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setPerPage(100);


        $this->setSortingStatus(false);
    }

    public function filters(): array
    {
        $schools = Ongoinglistendorseds::select('school')->distinct()->pluck('school', 'school')->toArray();
        $semesters = Ongoinglistendorseds::select('semester')->distinct()->pluck('semester', 'semester')->toArray();
        $years = Ongoinglistendorseds::select('year')->distinct()->pluck('year', 'year')->toArray();
        return [
            SelectFilter::make('School')
                ->options(['' => 'All'] + $schools)
                ->filter(function (Builder $builder, string $value) {
                    if ($value !== '') {
                        $builder->where('Ongoinglistendorseds.school', 'like', '%' . $value . '%');
                    }
                }),
            SelectFilter::make('Semester')
                ->options(['' => 'All'] + $semesters)
                ->filter(function (Builder $builder, string $value) {
                    if ($value !== '') {
                        $builder->where('Ongoinglistendorseds.semester', 'like', '%' . $value . '%');
                    }
                }),
            SelectFilter::make('Year')
                ->options(['' => 'All'] + $years)
                ->filter(function (Builder $builder, string $value) {
                    if ($value !== '') {
                        $builder->where('year', '=', $value);
                    }
                }),

        ];
    }

    public function builder(?string $year = null): EloquentBuilder
    {

        return Ongoinglistendorseds::query()->where('year', 2024);
    }

    private function refreshData()
    {
        // Construct the query based on the current filter settings
        $query = Ongoinglistendorseds::query();

        foreach ($this->selectedFilters as $filterType => $value) {
            switch ($filterType) {
                case 'year':
                    $query->where('year', $value);
                    break;
                    // Handle other filters...
            }
        }

        // Execute the query and update the table data
        $this->data = $query->get();
    }

    public function onFilterChange(string $filterType, $value)
    {

        $this->selectedFilters[$filterType] = $value;


        $this->refreshData();
    }

    public function bulkActions(): array
    {
        return [
            'endorseSelected' => 'Export to Word',
            'Append' => 'Stipend',
        ];
    }



    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("School", "school")
                ->sortable(),
            Column::make("Course", "course")
                ->sortable(),
            Column::make("Semester", "semester")
                ->sortable(),
            Column::make("Year", "year")
                ->sortable(),
        ];
    }
}
