<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailViewController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\SeiViewController;
use App\Http\Controllers\RsmsViewController;

use App\Http\Controllers\StudentViewController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\SeiQualifierviewController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WordController;
use Illuminate\Notifications\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//LOGOUT EXTRA PAUSE
// Route::get('/logged-out', [App\Http\Controllers\HomeController::class, 'index'])->name('logged-out');


Route::middleware(['auth', 'role:staff'])->group(function () {

    //NOTIFICATION COUNT
    Route::get('/notifications/count', [HeaderController::class, 'notificationsstaff'])->name('notificationsstaff');
    Route::get('/notifications', [HeaderController::class, 'notificationsgetall'])->name('notificationsgetall');
    //SEI
    Route::get('/seilist', [SeiViewController::class, 'seiqualifierview'])->name('seilist');
    Route::get('/seilistviewajax', [SeiViewController::class, 'seiqualifierviewajax'])->name('seilistviewajax');
    Route::get('/seilistviewajaxpotential', [SeiViewController::class, 'seilistviewajaxpotential'])->name('seilistviewajaxpotential');
    Route::get('/seilist2', [SeiViewController::class, 'seipotientalqualifierview'])->name('seilist2');
    Route::get('/sei/create', [SeiViewController::class, 'create'])->name('sei.create');
    Route::post('/sei', [SeiViewController::class, 'store'])->name('sei.store');
    // Route::post('/seilist2_edit', [SeiViewController::class, 'editinfo'])->name('seilist2.edit');
    Route::post('/seilist2_edit', [SeiViewController::class, 'edit'])->name('editscholar');
    Route::post('/seilist2_save', [SeiViewController::class, 'saveedit'])->name('sei.saveedit');
    Route::get('/get-seilistrecord/{number}', [SeiViewController::class, 'getOngoingSeilistById']);
    Route::post('/savechangesseilist/{number}', [SeiViewController::class, 'SaveChangesSeilist']);


    //EMAILS
    //EMAILS
    Route::get('/emails', [EmailViewController::class, 'emailstatusview'])->name('emails');
    Route::get('/emails2', [EmailViewController::class, 'emailstatusview2'])->name('emails2');
    Route::get('sendmail', [SendMailController::class, 'index'])->name('sendmail');
    Route::get('/emaileditor', [EmailViewController::class, 'emaileditorview'])->name('emaileditor');
    Route::get('/partials.emailcontent', [EmailViewController::class, 'emailcontentview'])->name('partials.emailcontent');

    //Email Save
    Route::post('ckeditor/upload', [\App\Http\Controllers\EmailSaveController::class, 'upload'])->name('ckeditor.upload');
    Route::post('/create', [\App\Http\Controllers\EmailSaveController::class, 'create'])->name('create');;

    //ACCESSCONTROL
    Route::get('/accesscontrol', [\App\Http\Controllers\AccessControlViewController::class, 'index'])->name('accesscontrol');
    Route::get('/accesscontrolongoing', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolongoingview'])->name('accesscontrolongoing');
    Route::get('/accesscontrolpending', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolpendingview'])->name('accesscontrolpending');
    Route::get('/accesscontrolenrolled', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolenrolledview'])->name('accesscontrolenrolled');
    Route::get('/accesscontroldeferred', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontroldeferredview'])->name('accesscontroldeferred');
    Route::get('/accesscontrolLOA', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolLOAview'])->name('accesscontrolLOA');
    Route::get('/accesscontrolterminated', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolterminatedview'])->name('accesscontrolterminated');
    Route::get('/enrollscholartoongoing/{id}', [\App\Http\Controllers\AccessControlViewController::class, 'enrollscholartoongoing'])->name('enrollscholartoongoing');

    //SCHOLAR FULL INFORMATION
    Route::get('/scholar_information/{id}', [\App\Http\Controllers\AccessControlViewController::class, 'scholar_information'])->name('scholar_information');
    //SCHOLAR FIRST REQUIREMENTS VIEW
    Route::get('/requirements_view/{id}', [\App\Http\Controllers\AccessControlViewController::class, 'requirements_view'])->name('requirements_view');
    //SCHOLAR PROCESS ENDORSE OR VERIFY
    Route::post('/scholarverifyendorse', [\App\Http\Controllers\AccessControlViewController::class, 'scholarverifyendorse'])->name('scholarverifyendorse');
    //SCHOLAR GET COG AND COR PUT TO MODAL
    Route::get('/scholarcog/{id}', [\App\Http\Controllers\AccessControlViewController::class, 'scholarcog'])->name('scholarcog');
    //SCHOLAR GET THESIS
    Route::get('/scholarthesis/{id}', [\App\Http\Controllers\AccessControlViewController::class, 'scholarthesis'])->name('scholarthesis');
    //SCHOLAR APPROVE COGCOR
    Route::get('/approvecogcor/{id}', [\App\Http\Controllers\AccessControlViewController::class, 'approvecogcor'])->name('approvecogcor');


    //ONGOINGLIST
    Route::get('/ongoinglist', [\App\Http\Controllers\RsmsViewController::class, 'ongoinglist'])->name('ongoinglist');
    Route::get('dashboard', [DashboardController::class, 'dashboardview'])->name('dashboard');
    Route::get('datatable/data', [RsmsViewController::class, 'getOngoingData'])->name('datatable.data');
    Route::get('/export-to-excel', 'RsmsActionController@exportToExcel');
    Route::get('/getongoingfiltered', [RsmsViewController::class, 'getOngoingDataFiltered'])->name('getongoingfiltered');
    Route::get('/getongoinglistgroupsajax', [RsmsViewController::class, 'getongoinglistgroupsajax'])->name('getongoinglistgroupsajax');
    Route::get('/getongoinglistgroupsajaxviewclicked', [RsmsViewController::class, 'getongoinglistgroupsajaxviewclicked'])->name('getongoinglistgroupsajaxviewclicked');


    //RSMS
    Route::get('/rsms', [RsmsViewController::class, 'rsmsview'])->name('rsms');
    Route::GET('/get-ongoing/{number}', [RsmsViewController::class, 'getOngoingById']);
    Route::get('/rsms2/{startyear}/{endyear}/{semester}', [RsmsViewController::class, 'rsmsview2'])->name('rsms2');
    Route::get('/rsmslistra7687', [RsmsViewController::class, 'rsmslistra7687view'])->name('rsmslistra7687');
    Route::get('/rsmslistra10612', [RsmsViewController::class, 'rsmslistra10612view'])->name('rsmslistra10612');
    Route::get('/rsmslistmerit', [RsmsViewController::class, 'rsmslistmeritview'])->name('rsmsmerit');
    Route::get('/rsmslistnoncompliance', [RsmsViewController::class, 'rsmslistnoncomplianceview'])->name('rsmsnoncompliance');
    Route::POST('/savechangesongongoing/{number}', [RsmsViewController::class, 'savechangesongongoing'])->name('savechangesongongoing');
    Route::get('/viewscholarrecords/{number}', [RsmsViewController::class, 'viewscholarrecordsview'])->name('viewscholarrecords');
    Route::get('/getscholargrades/{number}', [RsmsViewController::class, 'getscholargrades'])->name('getscholargrades');
    Route::post('/savecholargrades/{number}', [RsmsViewController::class, 'savecholargrades'])->name('savecholargrades');
    Route::post('/completescholargrades/{number}', [RsmsViewController::class, 'completescholargrades'])->name('completescholargrades');
    Route::get('/getprospectusdata/{number}', [RsmsViewController::class, 'getprospectusdata'])->name('getprospectusdata');
    Route::get('/viewscholarprospectus/{number}', [RsmsViewController::class, 'viewscholarprospectus'])->name('viewscholarprospectus');
    Route::get('/officialrsms/{number}', [RsmsViewController::class, 'officialrsms'])->name('officialrsms');
    Route::get('/getscholarshipstatus/{number}', [RsmsViewController::class, 'getscholarshipstatus'])->name('getscholarshipstatus');
    Route::post('/savescholarshipstatus/{number}', [RsmsViewController::class, 'savescholarshipstatus'])->name('savescholarshipstatus');
    Route::get('/getdocumentsdata/{number}', [RsmsViewController::class, 'getdocumentsdata'])->name('getdocumentsdata');

    Route::get('/getprogramchartyearfilter/{year}', 'YourController@getProgramChartData');
    //ANONUNCEMENT
    Route::get('/announcement', [\App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcement');

    Route::get('/requests', [\App\Http\Controllers\RequestsController::class, 'index'])->name('requests');

    Route::post('/upload', [WordController::class, 'upload']);

    Route::post('/getallyearfilter', [DashboardController::class, 'getallyearfilter'])->name('getallyearfilter');
});

require __DIR__ . '/auth.php';

require __DIR__ . '/studentauth.php';

//Route::get('/student/dashboard', function () {
//    return view('student.dashboard');
//})->middleware(['auth:student', 'verified'])->name('student.dashboard');

Route::middleware(['auth:student', 'verified'])->group(function () {
    Route::get('student/profile', [StudentViewController::class, 'index'])->name('student.profile');
    Route::get('studentnoaccess', [StudentViewController::class, 'endaccess'])->name('studentnoaccess');
    Route::get('student/dashboard', [StudentViewController::class, 'dashboard'])->name('student.dashboard');
    Route::get('student/submitreqsperiodic', [StudentViewController::class, 'submitreqsperiodic'])->name('student.submitreqs');
    Route::POST('student/submitreqsperiodicsave', [StudentViewController::class, 'submitreqsperiodicsave'])->name('student.submitreqsperiodicsave');
    Route::get('student/viewsubmittedgrade', [StudentViewController::class, 'viewsubmittedgrade'])->name('student.viewsubmittedgrade');
    Route::get('student/replyslipview', [StudentViewController::class, 'replyslipview'])->name('student.replyslipview');
    Route::get('student/requestclearanceview', [StudentViewController::class, 'requestclearanceview'])->name('student.requestclearance');
    Route::post('replyslipsubmit', [\App\Http\Controllers\StudentActionsController::class, 'replyslipsave'])->name('replyslipsubmit');
    Route::post('student/submitgrades', [\App\Http\Controllers\StudentActionsController::class, 'cogsave'])->name('submitgrades');
    Route::get('student/gradeinput', [\App\Http\Controllers\StudentViewController::class, 'gradeinputview'])->name('student/gradeinput');
    Route::get('student/thesis', [\App\Http\Controllers\StudentViewController::class, 'thesisview'])->name('student/thesis');
    Route::post('thesissubmit', [\App\Http\Controllers\StudentViewController::class, 'thesissubmit'])->name('thesissubmit');
    Route::get('generatepdf/{number}', [\App\Http\Controllers\PrintController::class, 'generatePdf']);
    Route::get('/downloadpdfclearance/{filename}', [\App\Http\Controllers\StudentViewController::class, 'downloadpdfclearance'])->name('downloadpdfclearance');
    Route::POST('/savepdfclearance', [\App\Http\Controllers\StudentViewController::class, 'savepdfclearance'])->name('savepdfclearance');
    Route::POST('/studenteditcog', [\App\Http\Controllers\StudentViewController::class, 'studenteditcog'])->name('studenteditcog');
    Route::POST('/saveDraft', [\App\Http\Controllers\StudentActionsController::class, 'saveDraft'])->name('saveDraft');
    Route::POST('/savefirstrequirements', [\App\Http\Controllers\StudentViewController::class, 'savefirstrequirements'])->name('savefirstrequirements');

    Route::get('/notificationsgetspecific', [\App\Http\Controllers\HeaderController::class, 'notificationsgetspecific'])->name('notificationsgetspecific'); //GET NOTIFICATIONS
    Route::get('/notificationsscholar/count', [\App\Http\Controllers\HeaderController::class, 'notificationsscholarcount'])->name('notificationsscholarcount'); //GET NOTIFICATIONS
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboardadmin', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboardadmin');
    Route::get('/admin/approval', [\App\Http\Controllers\AdminController::class, 'indexadminapproval'])->name('adminapproval');
});
