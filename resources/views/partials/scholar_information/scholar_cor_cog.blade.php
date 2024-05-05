<div class="">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="">
                                <th colspan="7" style="text-align: center !important; background-color:rgb(144, 211, 228)">COG/COR Section</th>
                            </tr>
                            <tr class="">
                                <th class="" style="">Date Uploaded</th>
                                <th class="">Year</th>
                                <th class="">Semester</th>
                                <th style="text-align: center;" class="">COG Details</th>
                                <th style="text-align: center;" class="">COR Details</th>
                                <th class="">Remarks</th>
                                <th style="text-align: center; width: 15rem;" class="">Actions</th>
                                {{--      <th style="text-align: center; width: 15rem;" class="">Append</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cogpassed as $cogpassed1)
                                <tr class="">
                                    <td class="">{{ \Carbon\Carbon::parse($cogpassed1->date_uploaded)->format('F j, Y') }}</td>
                                    <td class="">{{ $cogpassed1->startyear }}</td>
                                    <td class="">{{ $cogpassed1->semester }}</td>
                                    <td class="" style="text-align: center;"><a data-cogid="{{ $cogpassed1->id }}" class="d-block viewcog thisisbutton btn btn-light"><i class="fas fa-eye"></i>&nbsp;View</a></td>
                                    <td class="" style="text-align: center;"><a data-corid="{{ $cogpassed1->id }}" class="d-block viewcor thisisbutton btn btn-light"><i class="fas fa-eye"></i>&nbsp;View</a></td>
                                    <td class="">{{ $cogpassed1->cogcor_remarks }}</td>
                                    <td class=" " style="text-align: center;">
                                        <div class="row g-2" style="">
                                            @if ($cogpassed1->cogcor_status == 'approved')
                                                <div class="col">
                                                    Approved
                                                </div>
                                            @elseif ($cogpassed1->cogcor_status == 'disapproved')
                                                <div class="col">
                                                    Disapproved
                                                </div>
                                            @else
                                                <div class="col">
                                                    <form action="{{ route('approvecogcor', ['id' => $cogpassed1->id]) }}" class="">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success thisisbutton"><i class="fas fa-check-square"></i>&nbsp;Approve</button>
                                                    </form>
                                                </div>
                                                <div class="col">
                                                    <form id="disapprovecogForm" action="{{ route('approvecogcor', ['id' => $cogpassed1->id]) }}" class="">
                                                        @csrf
                                                        <input type="text" hidden style="display:none" name="disapprovecor" value="0">
                                                        <button type="button" class="btn btn-sm btn-danger thisisbutton " id="disapprovecogButton"><i class="fas fa-times-circle"></i>&nbsp;Disapprove</button>
                                                    </form>
                                                    <script>
                                                        document.querySelector('#disapprovecogButton').addEventListener('click', function() {
                                                            // Show SweetAlert
                                                            Swal.fire({
                                                                title: 'Disapprove this thesis COR/COG?',
                                                                html: `
                                                                        <textarea id="remarks" class="form-control" placeholder="Remarks"></textarea>
                                                                                `,
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Yes, disapprove',

                                                            }).then((result) => {

                                                                if (result.isConfirmed) {
                                                                    var remarks = document.getElementById('remarks').value;
                                                                    document.getElementById('disapprovecogForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="cogremarks" value="${remarks}">`);
                                                                    document.getElementById('disapprovecogForm').submit();
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    {{--   <td class="">{{ $cogpassed1->cogcor_remarks }}</td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
