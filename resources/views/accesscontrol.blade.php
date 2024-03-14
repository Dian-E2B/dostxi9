 <!DOCTYPE html>
 <html lang="en">

     <head>
         <title>DOST XI</title>
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
         <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">

         {{-- Jquery Js --}}
         <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
         <style>
             box-icon {
                 padding: 0;
                 margin: 0;
                 border: none;
             }
         </style>
     </head>

     <body>
         @include('layouts.sidebarnew')
         @include('layouts.headernew')
         <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">
             <div class="main">


                 <main class="main">
                     <div class="container-fluid p-2">


                         <div class="col-12">


                             <div class="card">

                                 <div style="margin-bottom: -10px;" class="card-header">
                                     <div class="row">
                                         <div class="col-8">
                                             <h5 class="card-title">Scholars</h5>
                                             <h6 class="card-subtitle text-muted">All scholars that have access to the
                                                 system
                                                 after accepting notice of awards.
                                             </h6>
                                         </div>



                                     </div>

                                 </div>

                                 <div class="card-body">
                                     <table id="thisdatatable" style="margin-bottom: 1rem !important;" class="table table-striped table-sm">
                                         <thead>
                                             <tr>
                                                 <th>ID</th>
                                                 <th>SCHOLARSHIP BATCH</th>
                                                 <th>NAME</th>
                                                 <th>M/F</th>
                                                 <th class="d-none d-md-table-cell">Email</th>
                                                 <th class="d-none d-md-table-cell">Status</th>
                                                 <th>Action</th>
                                                 @if (request()->is('accesscontrolpending'))
                                                     <th>Requirements</th>
                                                 @endif
                                             </tr>
                                         </thead>
                                         <tbody>


                                             @if (request()->is('accesscontrol'))

                                                 @foreach ($seisallstatus as $seisallstatus1)
                                                     <tr>
                                                         <td>{{ $seisallstatus1->id }}</td>

                                                         <td>{{ $seisallstatus1->year }}</td>

                                                         <td>{{ $seisallstatus1->lname }},
                                                             {{ $seisallstatus1->fname }}
                                                             {{ $seisallstatus1->mname }} </td>
                                                         <td>
                                                             @if ($seisallstatus1->gender_id == 1)
                                                                 F
                                                             @else
                                                                 M
                                                             @endif

                                                         </td>
                                                         <td class="">{{ $seisallstatus1->email }}</td>
                                                         <td>
                                                             @switch($seisallstatus1->scholar_status_id)
                                                                 @case(1)
                                                                     <span style="color: blue;"><strong>Pending</strong></span>
                                                                 @break

                                                                 @case(2)
                                                                     <span style="color: deepskyblue;"><strong>Ongoing</strong></span>
                                                                 @break

                                                                 @case(3)
                                                                     <span style="color: green;"><strong>Enrolled</strong></span>
                                                                 @break

                                                                 @case(4)
                                                                     <span style="color: orange;"><strong>Deferred</strong></span>
                                                                 @break

                                                                 @case(5)
                                                                     <span style="color: red;"><strong>LOA</strong></span>
                                                                 @break

                                                                 @case(6)
                                                                     <span style="color: black;"><strong>Terminate</strong></span>
                                                                 @break

                                                                 @case(7)
                                                                     <span style="color: black;"><strong>Not Availed</strong></span>
                                                                 @break

                                                                 @default
                                                                     <!-- Default case if scholar_status_id doesn't match any case -->
                                                             @endswitch
                                                         <td class="table-action d-flex align-items-center">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><box-icon type='solid' size="1.1rem" name='lock-alt'></box-icon></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><box-icon size="1.1rem" type='solid' name='lock-alt'></box-icon></a>
                                                         </td>
                                                         </td>
                                                     </tr>
                                                 @endforeach
                                             @elseif(request()->is('accesscontrolpending'))
                                                 @foreach ($replyslipsandscholarjoinpending as $rasp)
                                                     @php
                                                         $scholarrequirements = \App\Models\Scholar_requirements::where('scholar_id', $rasp->id)->first();
                                                     @endphp
                                                     <tr>

                                                         <td>{{ $rasp->id }}</td>
                                                         <td>{{ $rasp->year }}</td>

                                                         <td>{{ $rasp->lname }},
                                                             {{ $rasp->fname }}
                                                             {{ $rasp->mname }} </td>
                                                         <td>
                                                             @if ($rasp->gender_id == 1)
                                                                 F
                                                             @else
                                                                 M
                                                             @endif
                                                         </td>
                                                         <td class="">{{ $rasp->email }}</td>
                                                         {{-- Pending --}}
                                                         <td style="color:blue">
                                                             <strong>Pending</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account"><i class="fas fa-trash"></i></a>
                                                             <a href="{{ route('scholar_information', ['id' => $rasp->id]) }}" style="color:  black; margin-left: 8px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Scholar Details"><i class="fas fa-eye"></i></a>
                                                         </td>
                                                         <td style="align-items: center">
                                                             @if (empty($scholarrequirements))
                                                                 No Uploads
                                                             @else
                                                                 Uploaded
                                                             @endif
                                                         </td>

                                                     </tr>
                                                 @endforeach
                                             @elseif(request()->is('accesscontrolongoing'))
                                                 @foreach ($replyslipsjoinscholarongoing as $replyslipsjoinscholarongoing1)
                                                     <tr>
                                                         <td>{{ $replyslipsjoinscholarongoing1->id }}</td>
                                                         <td>{{ $replyslipsjoinscholarongoing1->year }}</td>
                                                         <td>{{ $replyslipsjoinscholarongoing1->lname }},
                                                             {{ $replyslipsjoinscholarongoing1->fname }}
                                                             {{ $replyslipsjoinscholarongoing1->mname }} </td>
                                                         <td>
                                                             @if ($replyslipsjoinscholarongoing1->gender_id == 1)
                                                                 F
                                                             @else
                                                                 M
                                                             @endif
                                                         </td>
                                                         <td class="">{{ $replyslipsjoinscholarongoing1->email }}
                                                         </td>
                                                         <td style="color:deepskyblue">
                                                             <strong>{{ $replyslipsjoinscholarongoing1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                             <a href="{{ route('scholar_information', ['id' => $replyslipsjoinscholarongoing1->id]) }}" style="color:  black; margin-left: 8px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Scholar Details"><i class="fas fa-eye"></i></a>
                                                         </td>
                                                     </tr>
                                                 @endforeach
                                             @elseif(request()->is('accesscontrolenrolled'))
                                                 @foreach ($replyslipsjoinscholarenrolled as $replyslipsjoinscholarenrolled1)
                                                     <tr>
                                                         <td>{{ $replyslipsjoinscholarenrolled1->id }}</td>
                                                         <td>{{ $replyslipsjoinscholarenrolled1->year }}</td>
                                                         <td>{{ $replyslipsjoinscholarenrolled1->lname }},
                                                             {{ $replyslipsjoinscholarenrolled1->fname }}
                                                             {{ $replyslipsjoinscholarenrolled1->mname }} </td>
                                                         <td>
                                                             @if ($replyslipsjoinscholarenrolled1->gender_id == 1)
                                                                 F
                                                             @else
                                                                 M
                                                             @endif
                                                             {{--  {{ $seisterminated1->gender_id }} --}}
                                                         </td>
                                                         <td class="">{{ $replyslipsjoinscholarenrolled1->email }}
                                                         </td>
                                                         <td style="color:green">
                                                             <strong>{{ $replyslipsjoinscholarenrolled1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>

                                                         </td>
                                                 @endforeach
                                                 </tr>
                                             @elseif(request()->is('replyslipsjoinscholardeferred'))
                                                 @foreach ($replyslipsjoinscholardeferred as $replyslipsjoinscholardeferred1)
                                                     <tr>
                                                         <td>{{ $replyslipsjoinscholardeferred1->id }}</td>
                                                         <td>{{ $replyslipsjoinscholardeferred1->lname }},
                                                             {{ $replyslipsjoinscholardeferred1->fname }}
                                                             {{ $replyslipsjoinscholardeferred1->mname }} </td>
                                                         <td class="">{{ $replyslipsjoinscholardeferred1->email }}
                                                         </td>
                                                         <td style="color:green">
                                                             <strong>{{ $replyslipsjoinscholardeferred1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>

                                                         </td>
                                                     </tr>
                                                 @endforeach
                                             @elseif(request()->is(''))
                                                 @foreach ($replyslipsjoinscholarLOA as $replyslipsjoinscholarLOA1)
                                                     <tr>
                                                         <td>{{ $replyslipsjoinscholarLOA1->id }}</td>
                                                         <td>{{ $replyslipsjoinscholarLOA1->lname }},
                                                             {{ $replyslipsjoinscholarLOA1->fname }}
                                                             {{ $replyslipsjoinscholarLOA1->mname }} </td>
                                                         <td class="">{{ $replyslipsjoinscholarLOA1->email }}
                                                         </td>
                                                         <td style="color:green">
                                                             <strong>{{ $replyslipsjoinscholarLOA1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                         </td>
                                                     </tr>
                                                 @endforeach
                                             @elseif(request()->is('accesscontrolterminated'))
                                                 @foreach ($seisterminated as $seisterminated1)
                                                     <tr>
                                                         <td>{{ $seisterminated1->id }}</td>
                                                         <td>{{ $seisterminated1->year }}</td>
                                                         <td>{{ $seisterminated1->lname }},
                                                             {{ $seisterminated1->fname }}
                                                             {{ $seisterminated1->mname }}</td>
                                                         <td>
                                                             @if ($seisterminated1->gender_id == 1)
                                                                 F
                                                             @else
                                                                 M
                                                             @endif
                                                             {{--  {{ $seisterminated1->gender_id }} --}}
                                                         </td>
                                                         <td class="">
                                                             {{ $seisterminated1->email }}</td>
                                                         <td style="color:green">
                                                             <strong>{{ $seisterminated1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                         </td>
                                                     </tr>
                                                 @endforeach


                                         </tbody>
                                     @else
                                         @endif





                                 </div>
                             </div>



                         </div>
                 </main>
             </div>
         </main>
         <script src="{{ asset('js/app.js') }}"></script>
         <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
         <script>
             jQuery(document).ready(function($) {
                 var table = $('#thisdatatable').DataTable({});
             });
         </script>
     </body>


 </html>
