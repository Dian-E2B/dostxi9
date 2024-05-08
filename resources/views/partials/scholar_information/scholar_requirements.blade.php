{{-- @dd($scholarrequirements->prospectus_name); --}}
<div class="">
    <table class="table d-flex table-bordered table-sm align-text-center" style="width: 100%; vertical-align: middle !important">
        <input type="hidden" value="{{ $scholarrequirements->scholar_id }}" name="scholar_id" id="scholar_id">
        <thead class="">
            <tr>
                <th colspan="4" class="" style="text-align: center !important; background-color:rgb(144, 211, 228)">Requirements Uploaded</th>
            </tr>
            <tr>

                <th class="" style="">Scholarship Agreement</th>
                <td class="tdviewreq">
                    @if (!empty($scholarrequirements))
                        <a href="{{ asset($scholarrequirements->scholarshipagreement_name) }}" target="_blank" class="d-block viewreqinformation btn btn-sm btn-light thisisbutton">View</a>
                    @else
                        No File Uploaded
                    @endif
                </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">yes</button> </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">no</button> </td>
            </tr>
            <tr class="">
                <th class="">Information Sheet</th>
                <td class="tdviewreq"><span class="">
                        @if (!empty($scholarrequirements))
                            <a href="{{ asset($scholarrequirements->infosheet_name) }}" target="_blank" class="d-block  btn btn-sm btn-light thisisbutton">View</a>
                        @else
                            No File Uploaded
                        @endif
                    </span>

                </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">yes</button> </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">no</button> </td>
            </tr>
            <tr class="">
                <th class="">Scholar's Oath</th>
                <td class="tdviewreq">
                    @if (!empty($scholarrequirements))
                        <a href="{{ asset($scholarrequirements->scholaroath_name) }}" target="_blank" class="d-block  btn btn-sm btn-light thisisbutton">View</i></a>
                    @else
                        No File Uploaded
                    @endif
                </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">yes</button> </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">no</button> </td>
            </tr>
            <tr class="">
                <th class="">Prospectus</th>
                <td class="tdviewreq">
                    @if (!empty($scholarrequirements))
                        <a href="{{ asset($scholarrequirements->prospectus_name) }}" target="_blank" class="d-block  btn btn-sm btn-light thisisbutton">View</a>
                    @else
                        No File Uploaded
                    @endif
                </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">yes</button> </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">no</button> </td>
            </tr>
            <tr class="">
                <th class="">COR (Requirement)</th>
                <td class="tdviewreq">
                    @if (!empty($scholarrequirements))
                        <a href="{{ asset($scholarrequirements->cor_name) }}" target="_blank" class="d-block  btn btn-sm btn-light thisisbutton">View</a>
                    @else
                        No File Uploaded
                    @endif
                </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">yes</button> </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">no</button> </td>
            </tr>
            <tr class="">
                <th class="">Account Number</th>

                <td class="tdviewreq">
                    @if (!empty($scholarrequirements))
                        <a href="{{ asset($scholarrequirements->accnumber_name) }}" target="_blank" class="d-block btn btn-sm btn-light thisisbutton">View</a>
                    @else
                        No File Uploaded
                    @endif
                </td>
                <td class="tdviewreq">
                    <button type="button" class="btn btn-light btn-sm" onclick="submityesaccform('yes')">Yes</button>
                    <input type="hidden" name="decisionacc" id="decisionacc">
                </td>
                <td class="">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#noaccform">
                        No
                    </button>
                    <div class="modal fade" id="noaccform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Disapprove Account Number</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="decisionacc" value="No" id="decisionacc">
                                    <input name="remarks" class="form-control" placeholder="Remarks" value="" id="remarks">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" onclick="submitnoaccform('no')">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="">
                <td colspan="4"> {{-- SUBMIT VERIFY --}}
                    <form id="formverify" method="POST" action="{{ route('scholarverifyendorse') }}">
                        @csrf
                        <input type="hidden" name="namescholar_id" value="{{ $seisourcerecord->id }}">
                        {{--   <input type="hidden" name="namedata_id" value="{{ $scholarrequirements->scholar_id }}"> --}}
                        <input type="hidden" name="nameprocess" id="scholarprocess" value="">
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex justify-content-start align-items-center">
                                    @php
                                        $replyslipverified = \App\Models\Replyslips::where('scholar_id', $seisourcerecord->id)->first();
                                    @endphp
                                    @if ($replyslipverified)
                                        @if ($replyslipverified->replyslip_status_id == 5)
                                            <button disabled class="btn btn-success btn-sm">Verified</button><span class="px-2"></span>
                                        @else
                                            <button type="submit" class="btn btn-success btn-sm" onclick="submitFormverify('verify');"> </button><span class="px-2"></span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-start align-items-center">
                                    <button type="submit" class="btn btn-primary btn-sm" onclick="submitFormverify('endorse');">Endorse to other region</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </thead>
    </table>
</div>
