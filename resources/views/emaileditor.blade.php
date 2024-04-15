<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI - SIMS</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/decoupled-document/ckeditor.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Jquery Js --}}
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
    </head>

    <body>
        @include('layouts.headernew') {{-- HEADER START --}}
        @include('layouts.sidebarnew') {{-- SIDEBAR START --}}

        <main id="main" class="main" style="padding:1.5rem 1.0rem 1.0rem; !important;">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div>
                                    <h5 class="card-title"> Email Edit</h5>
                                </div>

                                <input type="hidden" name="action" id="action" value="create">
                                <div id="toolbar-container"></div>

                                <?php echo csrf_field(); ?>
                                <div style="margin-left:0.6rem; color: gray; margin-top: 0.5rem;">Congratulations for qualifying for the [YEAR NOW] DOST-SEI S&T Undergraduate Scholarships under <strong style="color: red">[PROGRAM]</strong>.</div>
                                <!-- This container will become the editable. -->
                                <div id="editor">
                                    {!! $emailContent->content ?? 'Enter your email' !!}
                                </div>


                                <button type="button" style="max-width: 200px ;  margin-bottom: 0.5rem; margin-top: 1rem;" id="submit" class="btn btn-primary rounded-pill">Submit
                                </button>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </main>


    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/fontaws.js') }}"></script>

    <script>
        //let editor;
        DecoupledEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                }
            })
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');
                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                document.querySelector('#submit').addEventListener('click', () => {
                    // Get the CKEditor data
                    const editorData = editor.getData();
                    if (typeof editorData !== 'undefined') {
                        retrievedd = editorData;
                        /*   console.log('DATA:', editorData); */

                        // Send the data to the server using AJAX
                        $.ajax({
                            url: "{{ route('create') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                content: editorData,
                            },
                            success: function(response) {
                                // Handle the server's response (if needed)
                                /*  console.log('Data saved to the database:', response); */
                                swal.fire({
                                    icon: 'success',
                                    text: 'Email has been saved.',
                                    title: "",
                                })
                            },
                            error: function(error) {
                                console.error('Error:', error);
                            }
                        });
                    } else {
                        console.error('retrieveddata is not defined or initialized.');
                    }
                });
            })
            .catch(error => {
                console.error('Error during CKEditor initialization:', error);
            });
    </script>
    <script></script>

</html>
