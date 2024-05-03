<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class DashboardControllerView extends Controller
{
    //
    public function dashboardview()
    {
        return view('dashboard');
    }

    public function dashboardgraph()
    {
        $ongoingPROGRAM = DB::table('ongoing')
            ->select('startyear', 'scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
            ->whereNotNull('scholarshipprogram')
            ->whereBetween('startyear', [date('Y') - 4, date('Y')]) // Fetch data for the last 5 years (2020 to 2024)
            ->groupBy('startyear', 'scholarshipprogram')
            ->get();

        $chartData = [];
        foreach ($ongoingPROGRAM as $program) {
            $chartData[$program->startyear][$program->scholarshipprogram] = $program->scholarshipprogramcount;
        }

        return response()->json($chartData);
    }
}
