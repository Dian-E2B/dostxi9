<div class="">
    <table class="table d-flex table-bordered table-sm align-text-center" style="width: 100%; vertical-align: middle !important">
        <thead class="">
            <tr>
                <th colspan="4" class="" style="text-align: center !important; background-color:rgb(144, 211, 228)">Requirements Uploaded</th>
            </tr>
            <tr>
                <th class="" style="">Scholarship Agreement</th>
                <td class="tdviewreq">
                    @if (!empty($scholarrequirements))
                        <a href="{{ asset($scholarrequirements->scholarshipagreement) }}" target="_blank" class="d-block viewreqinformation btn btn-sm btn-light thisisbutton"><i class="fas fa-eye"></i></a>
                    @else
                        No File Uploaded
                    @endif
                </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">t</button> </td>
                <td class="tdviewreq"><button class="btn btn-light btn-sm">t</button> </td>
            </tr>
            <tr class="">
                <th class="">Information Sheet</th>
                <td class="tdviewreq"><span class="">
                        @if (!empty($scholarrequirements))
                            <a href="{{ asset($scholarrequirements->informationsheet) }}" target="_blank" class="d-block viewreqinformation btn btn-sm btn-light thisisbutton"><i class="fas fa-eye"></i></a>
                        @else
                            No File Uploaded
                        @endif
                    </span>

                </td>
                <td class=""></td>
            </tr>
            <tr class="">
                <th class="">Scholar's Oath</th>
                <td class="tdviewreq">
                    @if (!empty($scholarrequirements))
                        <a href="{{ asset($scholarrequirements->scholaroath) }}" target="_blank" class="d-block viewreqinformation btn btn-sm btn-light thisisbutton"><i class="fas fa-eye"></i></a>
                    @else
                        No File Uploaded
                    @endif
                </td>
            </tr>
            <tr class="">
                <th class="">Prospectus</th>
                <td class="tdviewreq">
                    @if (!empty($scholarrequirements))
                        <a href="{{ asset($scholarrequirements->propectus) }}" class="d-block viewreqprospectus btn btn-sm btn-light thisisbutton"><i class="fas fa-eye"></i></a>
                    @else
                        No File Uploaded
                    @endif
                </td>
            </tr>
            <tr class="">
                <th class="">COR</th>
                <td class="tdviewreq">
                    @if (!empty($scholarrequirements))
                        <a href="{{ asset($scholarrequirements->cor_first) }}" class="d-block viewreqprospectus btn btn-sm btn-light thisisbutton"><i class="fas fa-eye"></i></a>
                    @else
                        No File Uploaded
                    @endif
                </td>
            </tr>
            <tr class="">
                <td colspan="2"> {{-- SUBMIT VERIFY --}}
                    <form id="formverify" method="POST" action="{{ route('scholarverifyendorse') }}">
                        @csrf
                        <input type="hidden" name="namescholar_id" value="{{ $seisourcerecord->id }}">
                        <input type="hidden" name="namedata_id" value="{{ $scholarrequirements->id }}">
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
                                            <button type="submit" class="btn btn-success btn-sm" onclick="submitFormverify('verify');">Verify</button><span class="px-2"></span>
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
