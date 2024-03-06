<?php

namespace App\Http\Controllers;

use App\Exports\ExportOngoing;
use App\Exports\YourExportClassName;
use App\Models\Ongoing;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class RsmsActionController extends Controller
{
    //

    public function exportToExcel()
{
    $data = Ongoing::all(); // Fetch your data from the database

    return Excel::download(new ExportOngoing($data), 'your_filename.xlsx');

}
}
