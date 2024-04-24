<?php
Route::middleware(['auth:student', 'verified'])->group(function () {
    Route::post('editschoolcourse', [StudentProfileController::class, 'editschoolcourse'])->name('editschoolcourse');
    Route::get('student/profile', [StudentProfileController::class, 'index'])->name('student.profile');
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

    //THESIS SECTION
    Route::get('student/thesis', [ThesisController::class, 'thesisview'])->name('student/thesis');

    Route::post('thesissubmit', [ThesisController::class, 'thesissubmit'])->name('thesissubmit');
    Route::post('finalmanuscriptsubmit', [ThesisController::class, 'finalmanuscriptsubmit'])->name('finalmanuscriptsubmit');
    Route::post('finalmanuscriptresubmit', [ThesisController::class, 'finalmanuscriptresubmit'])->name('finalmanuscriptresubmit');

    Route::get('generatepdf/{number}', [\App\Http\Controllers\PrintController::class, 'generatePdf']);
    Route::get('/downloadpdfclearance/{filename}', [\App\Http\Controllers\StudentViewController::class, 'downloadpdfclearance'])->name('downloadpdfclearance');
    Route::POST('/savepdfclearance', [\App\Http\Controllers\StudentViewController::class, 'savepdfclearance'])->name('savepdfclearance');
    Route::POST('/studenteditcog', [\App\Http\Controllers\StudentViewController::class, 'studenteditcog'])->name('studenteditcog');
    Route::POST('/saveDraft', [\App\Http\Controllers\StudentActionsController::class, 'saveDraft'])->name('saveDraft');
    Route::POST('/savefirstrequirements', [\App\Http\Controllers\StudentViewController::class, 'savefirstrequirements'])->name('savefirstrequirements');

    Route::get('/notificationsgetspecific', [\App\Http\Controllers\HeaderController::class, 'notificationsgetspecific'])->name('notificationsgetspecific'); //GET NOTIFICATIONS
    Route::get('/notificationsscholar/count', [\App\Http\Controllers\HeaderController::class, 'notificationsscholarcount'])->name('notificationsscholarcount'); //GET NOTIFICATIONS
    Route::get('studentnotificationclear/{id}', [HeaderController::class, 'studentnotificationclear']);

    Route::POST('reuploadcogcor', [\App\Http\Controllers\StudentViewController::class, 'reuploadcogcor'])->name('reuploadcogcor'); //REUPLOAD COR
    Route::POST('thesissubmitreupload', [\App\Http\Controllers\StudentViewController::class, 'thesissubmitreupload'])->name('thesissubmitreupload'); //REUPLOAD COR
});
