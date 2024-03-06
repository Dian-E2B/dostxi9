<?php

namespace App\Http\Controllers;

use App\Models\EmailContent;
use App\Models\Replyslips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailViewController extends Controller
{
    //

    public function emailcontentview()
    {

        $content = EmailContent::first();
        return view('partials.emailcontent', compact('content'));
    }

    public function emaileditorview()
    {
        $emailContent = EmailContent::first();
        if (!$emailContent) {
            //abort(404); // Handle not found scenario
        }
        return view('/emaileditor', ['emailContent' => $emailContent]);
    }

    public function emailstatusview()
    {
        $replyslipsandscholarjoinpending = Replyslips::join('seis', 'replyslips.scholar_id', '=', 'seis.id')
            ->select('replyslips.*', 'seis.*')
            ->where('replyslips.replyslip_status_id', 1)
            ->get();

        $replyslipsandscholarjoinaccepted = Replyslips::join('seis', 'replyslips.scholar_id', '=', 'seis.id')
            ->select('replyslips.*', 'seis.*')
            ->where('replyslips.replyslip_status_id', 2)
            ->get();

        // dd($replyslipsandscholarjoinaccepted);

        $replyslipsandscholarjoinrejected = Replyslips::join('seis', 'replyslips.scholar_id', '=', 'seis.id')
            ->select('replyslips.*', 'seis.*')
            ->where('replyslips.replyslip_status_id', 3)
            ->get();

        $replyslipsandscholarjoindeferred = Replyslips::join('seis', 'replyslips.scholar_id', '=', 'seis.id')
            ->select('replyslips.*', 'seis.*')
            ->where('replyslips.replyslip_status_id', 4)
            ->get();

        $replyslipsandscholarjoinattended = Replyslips::join('seis', 'replyslips.scholar_id', '=', 'seis.id')
            ->select('replyslips.*', 'seis.*')
            ->where('replyslips.replyslip_status_id', 6)
            ->get();
        return view(
            'emails',
            compact(
                'replyslipsandscholarjoinpending',
                'replyslipsandscholarjoinaccepted',
                'replyslipsandscholarjoinrejected',
                'replyslipsandscholarjoindeferred',
                'replyslipsandscholarjoinattended'
            )
        );
    }
}
