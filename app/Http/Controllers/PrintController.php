<?php

namespace App\Http\Controllers;

use App\Models\Cog;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Log;

class PrintController extends Controller
{


    //   $templatePath = public_path('GRADESBLANK.pdf');

    public function generatePdf($number)
    {
        try {
            $results = Cog::select('startyear', DB::raw('COUNT(*) as row_count'))
                ->where('scholar_id', 1)
                ->groupBy('startyear')
                ->get();

            // Convert the Eloquent collection to an array
            $resultArrayyear = $results->pluck('startyear')->toArray();

            $resultArray = [];

            foreach ($resultArrayyear as $year) {
                // Fetching data for consecutive semesters with the same year
                for ($semester = 1; $semester <= 3; $semester++) {
                    $cogdata = Cog::with('cogdetails')
                        ->where('scholar_id', $number)
                        ->where('semester', $semester)
                        ->where('startyear', $year)
                        ->get();
                    //
                    // Store the data for the semester in the result array
                    $resultArray[$year][$semester] = $cogdata->toArray(); // Include all columns

                }
            }

            // Specify the path to your existing PDF template
            $templatePath = public_path('GRADESBLANK.pdf');

            // Create a new instance of FPDI
            $pdf = new Fpdi();

            // Add a page to the PDF (optional, you can skip this if you want to use an existing PDF)
            $pdf->AddPage();

            // Set font and font size (adjust as needed)
            $pdf->SetFont('Arial', '', 6);

            // Import the existing PDF template
            $pdf->setSourceFile($templatePath);
            $templateId = $pdf->importPage(1);

            // Use the template
            $pdf->useTemplate($templateId, 0, 0, 210);


            $y = 49; // Initial Y coordinate



            foreach ($resultArray as $year => $semesters) {
                foreach ($semesters as $semester => $data) {
                    Log::info("Year: $year, Semester: $semester");

                    foreach ($data as $item) {
                        foreach ($item['cogdetails'] as $cogDetail) {
                            // Access individual properties from the cogDetail
                            $subjectName = $cogDetail['subjectname'];
                            $grade = $cogDetail['grade'];
                            $unit = $cogDetail['unit'];

                            // Use the Text method to add text to the PDF
                            Log::info("Adding to PDF: Year: $year, Semester: $semester, Subject: $subjectName, Grade: $grade, Unit: $unit");
                            $pdf->Text(29, $y, "Year: $year, Semester: $semester, Subject: $subjectName, Grade: $grade, Unit: $unit");
                            $y += 4; // Adjust the value based on your layout
                        }
                    }
                }
                $y += 62.2; // Adjust the value based on your layout
            }

            // If you want to add a text outside the loop, do it here
            // $pdf->Text(29, $y, 'Text outside the loop');


            return response()->stream(
                function () use ($pdf) {
                    $pdf->Output('php://output', 'I');
                },
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename=filled_template.pdf',
                ]
            );


            // If you want to stream the file to the browser, use:
            // $pdf->Output('filled_template.pdf', 'I');
        } catch (\Exception $e) {
            // Log the exception
            Debugbar::info($e->getMessage());
            Debugbar::info($e->getTraceAsString());

            // Return an error response or redirect as needed
            // return response()->json(['error' => $e]);
        }
    }
}
