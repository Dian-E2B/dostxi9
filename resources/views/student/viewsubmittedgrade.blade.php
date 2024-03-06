<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>DOST</title>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <style>
            table,
            td,
            th {
                border: 3px solid black;
                border-color: black;
            }

            input {
                /*  border: none; */
            }

            input:focus {
                outline: none;
                /*   border: none; */
            }

            /* Add a border back when the input is hovered (optional) */
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">


            <div class="main">
                <main class="content" style="padding: 1rem 1rem 1rem !important;">
                    <div class="container-fluid p-0">

                        <div class="card">

                            <div class="card-body">
                                <h2>Academic Records (Sample)</h2>



                                <table id="thisdatatable" class="hover table table-bordered compact nowrap" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Academic Year</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Grade</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col" style="text-align: center">Completed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cogs as $cog)
                                            @php
                                                $subjectNames = explode(',', $cog->Subjectname);
                                                $grades = explode(',', $cog->Grade);
                                                $units = explode(',', $cog->Units);
                                                $completed = explode(',', $cog->Completed);
                                            @endphp

                                            @for ($i = 0; $i < count($subjectNames); $i++)
                                                <tr>
                                                    @if ($i == 0)
                                                        <td rowspan="{{ count($subjectNames) }}">{{ $cog->startyear }}</td>
                                                        <td rowspan="{{ count($subjectNames) }}">{{ $cog->semester }}</td>
                                                    @endif

                                                    <td>{{ $subjectNames[$i] }}</td>

                                                    @if ($completed[$i] == 1)
                                                        <td>{{ $grades[$i] }}</td>
                                                    @else
                                                        <td> {{ $grades[$i] }}</td>
                                                        {{--  <td style="max-width: 200px">
                                                            <form action="{{ route('studenteditcog') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="cog_id" value="{{ explode(',', $cog->id)[$i] }}">
                                                                <input type="text" name="grade" placeholder="Enter Grade" value="{{ $grades[$i] }}">
                                                                <button class="btn btn-pill btn-success" type="submit">Update</button>
                                                            </form>
                                                        </td> --}}
                                                    @endif

                                                    <td>{{ $units[$i] }}</td>
                                                    <td style="text-align: center">{{ $completed[$i] == 1 ? 'Yes' : 'No' }}</td>
                                                </tr>
                                            @endfor
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>




                </main>
            </div>
        </div>
        </div>


    </body>
    <script></script>

</html>
