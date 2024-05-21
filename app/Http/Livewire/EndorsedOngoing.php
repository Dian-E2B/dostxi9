<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ongoinglistendorseds;
use Barryvdh\Debugbar\Facades\Debugbar;
use DateTime;
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
use Livewire\Component;

class EndorsedOngoing extends DataTableComponent
{
    use LivewireAlert;
    protected $model = Ongoinglistendorseds::class;
    public $startyear;
    public $semester;
    public $date;

    public function mount($startyear, $semester)
    {
        $this->startyear = $startyear;
        $this->semester = $semester;
    }

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

        $phpWord = new PhpWord();
        $recorddate = Ongoinglistendorseds::find($selectedIds)->first();
        $dateString = $recorddate->created_at;
        $date = new DateTime($dateString);
        $formattedDate = $date->format("F j,Y");

        $section = $phpWord->addSection([
            'paperSize' => 'A4',
            'orientation' => 'portrait',
            'marginLeft' => 1440, // Align to the left margin
            'marginRight' => 1440, // Align to the right margin
            'marginTop' => 1500,
            'headerHeight' => 50,
        ]);

        $imagePath = public_path('icons/DOSTlogoONGOING.jpg');
        $header = $section->addHeader();
        $header->addImage(
            $imagePath,
            array(
                'width' => '550', // Your image width
                'height' => '70',
                'marginLeft' => \PhpOffice\PhpWord\Shared\Drawing::centimetersToPixels(-1.3),
                'marginRight' => \PhpOffice\PhpWord\Shared\Drawing::centimetersToPixels(-1.3),
                'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
                'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            )
        );


        $section->addText($formattedDate);
        $section->addText('Dear [????]:');
        $section->addText('Dear [????]:');
        $section->addText('Dear [????]:');
        $section->addText('Please be informed that the following students are scholars of the Department of Science and Technology under the Science and Technology Scholarship Program:');
        $phpWord->setDefaultFontSize(11);
        $phpWord->setDefaultFontName('Arial');


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
        $table->addCell(800)->addText('No', $fancyTableFontStyle, $firstRowStyle);
        $table->addCell(2000)->addText('BATCH', $fancyTableFontStyle, $firstRowStyle);
        $table->addCell(5000)->addText('NAME', $fancyTableFontStyle, $firstRowStyle);
        $table->addCell(2500)->addText('COURSE', $fancyTableFontStyle, $firstRowStyle);

        $counter = 1;


        foreach ($selectedIds as $id) {
            $record = Ongoinglistendorseds::find($id);
            $table->addRow();
            $table->addCell(800)->addText($counter, $fancyTableFontStyle, $firstRowStyle,);
            $table->addCell(2000)->addText($record->year, null, $fancyTableRowStyle);
            $table->addCell(5000)->addText($record->name, null, $fancyTableRowStyle);
            $table->addCell(2500)->addText($record->course, null, $fancyTableRowStyle);
            $counter++;
        }


        $setsemester = 0;
        if ($this->semester == 1) {
            $setsemester = "1st semester";
        } elseif ($this->semester == 2) {
            $setsemester = "2nd semester";
        } else {
            $setsemester = "Summer";
        }

        $section->addText('');
        $section->addText('Their tuition and other school fees not to exceed Twenty Thousand Pesos Only (P???) per scholar will be paid by the Department of Science and Technology Regional Office No. XI/DOST- SEI upon receipt of the corresponding bill from your office.');

        $textRun = $section->addTextRun();
        $section->addText('');
        $textRun->addText('This STATEMENT OF ADMISSION is valid for ');
        $textRun->addText('the ' . $setsemester . ' of AY ' . $this->startyear . '-' . $this->startyear + 1, ['bold' => true]);
        $textRun->addText(' only.');

        $section->addText('Very truly yours,');
        $section->addText('');
        $section->addText('DR. ANTHONY C. SALES, PFT, CESO III', $fancyTableFontStyle, $fancyTableRowStyle);
        $section->addText('Regional Director', $fancyTableRowStyle);

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
