<div class="card-body">
    <div class="row g-2">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered  table-sm align-text-center">
                    <thead>
                        <tr class="">
                            <th colspan="5" style="text-align: center; background-color:rgb(144, 211, 228)">Theses uploaded</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr class="">
                            <th class="">Date Uploaded</th>
                            <th class="">Remarks</th>
                            <th class="">Status</th>
                            <th style="text-align: center;" class="">Details</th>
                            <th style="text-align: center; width: 15rem" class="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($thesispassed as $thesispassed1)
                            <tr class="">
                                <td class="">{{ \Carbon\Carbon::parse($thesispassed1->updated_at)->format('F j, Y') }}</td>
                                <td class="">{{ $thesispassed1->thesis_remarks }}</td>
                                <td class="">{{ $thesispassed1->thesis_status }}</td>
                                <td class="" style="text-align: center;"><a data-thesisid="{{ $thesispassed1->id }}" class="viewthesis"><i class="fas fa-eye"></i></a></td>
                                <td class="" style="text-align: center;">

                                    @if ($thesispassed1->thesis_status == 'Approved')
                                        <div class="col">
                                            Approved
                                        </div>
                                    @elseif ($thesispassed1->thesis_status == 'Disapproved')
                                        <div class="col">
                                            Disapproved
                                        </div>
                                    @else
                                        <form action="{{ route('approvethesis') }}" id="thesisApprovalForm" method="POST">
                                            <div class="row g-2">
                                                <div class="col">
                                                    @csrf
                                                    <input type="text" name="thesis_id" hidden value="{{ $thesispassed1->id }}">
                                                    <button class="btn btn-sm btn-success thisisbutton" name="action" value="approve" type="submit"><i class="fas fa-check-square"></i>&nbsp;Approve</button>
                                                </div>
                                                <div class="col">
                                                    <button id="disapproveThesisButton" class="btn btn-sm btn-danger thisisbutton" value="disapprove" type="button"><i class="fas fa-times-circle"></i>&nbsp;Disapprove</button>
                                                </div>
                                            </div>
                                        </form>
                                        <script>
                                            document.querySelector('#disapproveThesisButton').addEventListener('click', function() {
                                                // Show SweetAlert
                                                Swal.fire({
                                                    title: 'Disapprove this thesis proposal?',
                                                    html: `
                                                        <textarea id="remarksthesis" class="form-control" placeholder="Remarks"></textarea>
                                                                `,
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Yes, disapprove',

                                                }).then((result) => {

                                                    if (result.isConfirmed) {
                                                        // Get remarks from the textarea
                                                        var remarksthesis = document.getElementById('remarksthesis').value;
                                                        document.getElementById('thesisApprovalForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="thesisremarks" value="${remarksthesis}">`);
                                                        document.getElementById('thesisApprovalForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="action" value="disapprove">`);
                                                        document.getElementById('thesisApprovalForm').submit();
                                                    }
                                                });
                                            });
                                        </script>
                                    @endif



                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if ($thesispassed[0]->finalmanuscript_details)
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered  table-sm align-text-center">
                    <thead class="">
                        <tr class="">
                            <th colspan="4" style="text-align: center; background-color:rgb(144, 211, 228)">Final Manuscript</th>
                        </tr>
                        <tr class="">
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Details</th>
                            <th class="text-center" style="width: 15rem">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <td class="">{{ $thesispassed[0]->finalmanus_remarks }}</td>
                        <td class=""><a class="d-flex p-1 justify-content-center" target="_blank" href="{{ asset($thesispassed[0]->finalmanuscript_details) }}"><i class="fas fa-eye"></i></a></td>
                        <td class="text-center">
                            @if ($thesispassed[0]->finalmanus_status == 'Approved' || $thesispassed[0]->finalmanus_status == 'Disapproved')
                                {{ $thesispassed[0]->finalmanus_status }}
                            @else
                                <form id="FinalManuscriptApprovalForm" action="{{ route('finalmanuscriptaction') }}" method="POST">
                                    @csrf
                                    <input type="text" name="thesis_id" hidden value="{{ $thesispassed[0]->id }}">
                                    <input type="submit" name="action" class="btn btn-success btn-sm thisisbutton" value="Approve" />
                                    <button id="disapproveFinalManusButton" type="button" name="action" class="btn btn-danger btn-sm thisisbutton">Disapprove</button>
                                </form>
                            @endif
                        </td>
                        <script>
                            document.querySelector('#disapproveFinalManusButton').addEventListener('click', function() {
                                Swal.fire({
                                    title: 'Disapprove this Final Manuscript?',
                                    html: `
                                    <textarea id="remarksFinal" class="form-control" placeholder="Remarks"></textarea>`,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, disapprove',

                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var remarksfinalmanus = document.getElementById('remarksFinal').value; // Get remarks from the textarea
                                        document.getElementById('FinalManuscriptApprovalForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="finalremarks" value="${remarksfinalmanus}">`);
                                        document.getElementById('FinalManuscriptApprovalForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="action" value="Disapprove">`);
                                        document.getElementById('FinalManuscriptApprovalForm').submit();
                                    }
                                });
                            });
                        </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
