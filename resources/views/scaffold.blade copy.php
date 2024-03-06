<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/all.css') }}">
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        {{-- SIDEBAR START --}}
        @include('layouts.sidebar')
        {{-- SIDEBAR END --}}



        <div class="main">
            @include('layouts.header')

            <main style="padding: 0.5rem 0.5rem 0.5rem 0.5rem" class="content">
                <div class="container-fluid p-0">

                    <div class="col-12 col-lg-12">
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">LOA</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab" role="tab">Shift/Transfer</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" href="#tab-3" data-bs-toggle="tab" role="tab">Messages</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1" role="tabpanel">
                                    <h4 class="tab-title">Leave of absence requests:</h4>
                                    <table id="thisdatatable" class="table-striped compact nowrap" style="width:100%;">
                                        <thead>
                                        <tr>
                                         <th>Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab-2" role="tabpanel">
                                    <h4 class="tab-title">Another one</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                                        rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                                    </p>
                                    <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                                        justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                                        justo.</p>
                                </div>
                                <div class="tab-pane" id="tab-3" role="tabpanel">
                                    <h4 class="tab-title">One more</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                                        rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                                    </p>
                                    <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                                        justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                                        justo.</p>
                                </div>
                            </div>
                        </div>



                </div>
            </main>
        </div>
    </div>
</body>
{{-- SIDEBAR TOGGLING --}}
<script src="{{ asset('js/all.js') }}"></script>
<script></script>

</html>
