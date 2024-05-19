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
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\Paper;
use PhpOffice\PhpWord\Style\Cell;

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

        // foreach ($selectedIds as $id) {

        //     $record = Ongoinglistendorseds::find($id);
        /*  if ($record) {
                // Perform your endorsement logic here, for example:
                $record->status_endorsement = 'endorsed'; // or whatever field and value you need
                $record->save();
            } */


        //     $this->alert('success',  $record->name);
        // }
        $phpWord = new PhpWord();


        $section = $phpWord->addSection([
            'paperSize' => 'A4',
            'orientation' => 'portrait',
            'marginLeft' => 1440,
            'marginRight' => 1440,

        ]);
        $section->addText('Text before the table.');
        $phpWord->setDefaultFontSize(11);
        $phpWord->setDefaultFontName('Arial');

        /*  // Add a table to the section
        $table = $section->addTable(); */

        // Add table headers

        /*    $tableStyle = array(
            'borderSize' => 6,
            'borderColor' => '000000',
            'marginTop' => 0,
            'marginRight' => 0,
            'marginBottom' => 0,
            'marginLeft' => 0,
            'exactHeight' => true,
            'cellMargin' => 0,
        ); */
        $fancyTableStyle = [
            'borderSize' => 1,
            'borderColor' => 'black',
            'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
            'leftFromText ' => 50,
            'tblpX' => 100,
            'cellMargin' => 20,
        ];

        $fancyTableRowStyle = [
            'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
            'spacing' => 0,
            'lineHeight' => 1,
            'tblpX' => 100,

        ];
        $firstRowStyle = array(
            'bgColor' => 'white',
            'alignment' => 'center',
            'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
            'spacing' => 0,
            'lineHeight' => 1,
        );
        $phpWord->addTableStyle('TableGrid', $fancyTableStyle);
        $table = $section->addTable('TableGrid');
        $fancyTableFontStyle = ['bold' => true];




        $table->addRow();
        $table->addCell(1000)->addText('No', $fancyTableFontStyle, $firstRowStyle);
        $table->addCell(1000)->addText('BATCH', $fancyTableFontStyle, $firstRowStyle);
        $table->addCell(5000)->addText('NAME', $fancyTableFontStyle, $firstRowStyle);
        $table->addCell(2500)->addText('COURSE', $fancyTableFontStyle, $firstRowStyle);


        $counter = 1;


        foreach ($selectedIds as $id) {
            $record = Ongoinglistendorseds::find($id);
            $table->addRow();
            $table->addCell(1000)->addText($counter, $fancyTableFontStyle, $firstRowStyle,);
            $table->addCell(1000)->addText($record->year, null, $fancyTableRowStyle);
            $table->addCell(5000)->addText($record->name, null, $fancyTableRowStyle);
            $table->addCell(2500)->addText($record->course, null, $fancyTableRowStyle);
            $counter++;
        }

        // Save the document
        $fileName = 'EndorsedOngoing.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $phpWord->save($tempFile, 'Word2007');
        $this->alert('success', 'Endorsed Approved!');
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
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
