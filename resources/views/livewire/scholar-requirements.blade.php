<div class="">
    <div class="mt-3">
        <div class="table-sm align-text-center justify-content-center" style="width: 100%; vertical-align: middle !important; ">
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
                    <td style="text-align: center !important" colspan="2" class="tdviewreq">
                        @if ($SAStatus == 2)
                            <button type="button" disabled class="d-block btn btn-light btn-sm">Disapproved</button>
                        @elseif($SAStatus == 1)
                            <button type="button" disabled class="d-block btn btn-success btn-sm">Approved</button>
                        @else
                            <div class="d-block" style="text-align: center !important">
                                <button class="btn btn-light btn-sm" wire:click="submitSA('yes')">yes</button>
                                <button style="margin-left: 10px;" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#noSAform">no</button>
                            </div>
                            <div class="modal fade" id="noSAform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="mb-1" style="text-align:start"> Scholarship Agreement Disapprove</div>
                                            <form wire:submit.prevent="submitSA('no')">
                                                <input class="form-control form-control-sm" wire:model.defer="SARemarks" placeholder="Remarks">
                                                <div style="text-align: start" class="mt-2">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
                <tr class="">
                    <th class="">Information Sheet</th>
                    <td class="tdviewreq">
                        <span class="">
                            @if (!empty($scholarrequirements))
                                <a href="{{ asset($scholarrequirements->infosheet_name) }}" target="_blank" class="d-block  btn btn-sm btn-light thisisbutton">View</a>
                            @else
                                No File Uploaded
                            @endif
                        </span>
                    </td>
                    <td style="text-align: center !important" colspan="2" class="tdviewreq">
                        @if ($ISStatus == 2)
                            <button type="button" disabled class="d-block btn btn-light btn-sm">Disapproved</button>
                        @elseif($ISStatus == 1)
                            <button type="button" disabled class="d-block btn btn-success btn-sm">Approved</button>
                        @else
                            <div class="d-block">
                                <button class="btn btn-light btn-sm" wire:click="submitIS('yes')">yes</button>
                                <button style="margin-left: 10px;" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#noISform">no</button>
                            </div>
                            <div class="modal fade" id="noISform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="mb-1" style="text-align:start">Information Sheet Disapprove</div>
                                            <form wire:submit.prevent="submitIS('no')">
                                                <input class="form-control form-control-sm" wire:model.defer="ISRemarks" placeholder="Remarks">
                                                <div style="text-align: start" class="mt-2">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
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
                    <td style="text-align: center !important" colspan="2" class="tdviewreq">
                        @if ($SOStatus == 2)
                            <button type="button" disabled class="d-block btn btn-light btn-sm">Disapproved</button>
                        @elseif($SOStatus == 1)
                            <button type="button" disabled class="d-block btn btn-success btn-sm">Approved</button>
                        @else
                            <div class="d-block">
                                <button class="btn btn-light btn-sm" wire:click="submitSO('yes')">yes</button>
                                <button style="margin-left: 10px;" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#nosaform">no</button>
                            </div>
                            <div class="modal fade" id="nosaform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="mb-1" style="text-align:start"> Scholar's Oath Disapprove</div>
                                            <form wire:submit.prevent="submitSO('no')">
                                                <input class="form-control form-control-sm" wire:model.defer="SORemarks" placeholder="Remarks">
                                                <div style="text-align: start" class="mt-2">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
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
                    <td style="text-align: center !important" colspan="2" class="tdviewreq">
                        @if ($prosStatus == 2)
                            <button type="button" disabled class="d-block btn btn-light btn-sm">Disapproved</button>
                        @elseif($prosStatus == 1)
                            <button type="button" disabled class="d-block btn btn-success btn-sm">Approved</button>
                        @else
                            <div class="d-block">
                                <button class="btn btn-light btn-sm" wire:click="submitpros('yes')">yes</button>
                                <button style="margin-left: 10px;" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#norposform">no</button>
                            </div>
                            <div class="modal fade" id="norposform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="mb-1" style="text-align:start"> Prospectus Disapprove</div>
                                            <form wire:submit.prevent="submitpros('no')">
                                                <input class="form-control form-control-sm" wire:model.defer="prosRemarks" placeholder="Remarks">
                                                <div style="text-align: start" class="mt-2">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
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
                    <td style="text-align: center !important" colspan="2" class="tdviewreq">
                        @if ($corstatus == 2)
                            <button type="button" disabled class="d-block btn btn-light btn-sm">Disapproved</button>
                        @elseif($corstatus == 1)
                            <button type="button" disabled class="d-block btn btn-success btn-sm">Approved</button>
                        @else
                            <div class="d-block">
                                <button class="btn btn-light btn-sm" wire:click="submitcor('yes')">yes</button>
                                <button style="margin-left: 10px;" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#nocorform">no</button>
                                <div class="modal fade" id="nocorform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="mb-1" style="text-align:start"> COR Requirement Disapprove</div>
                                                <form wire:submit.prevent="submitcor('no')">
                                                    <input class="form-control form-control-sm" wire:model.defer="corremarks" placeholder="Remarks">
                                                    <div style="text-align: start" class="mt-2">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
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
                    <td style="text-align: center !important" colspan="2" class="">
                        @if ($accnumstatus == 2)
                            <button type="button" disabled class="d-block btn btn-light btn-sm">Disapproved</button>
                        @elseif($accnumstatus == 1)
                            <button type="button" disabled class="d-block btn btn-success btn-sm">Approved</button>
                        @else
                            <div class="d-block">
                                <button type="button" class="btn btn-light btn-sm" wire:click="submitacc('yes')">yes</button>
                                <button type="button" style="margin-left: 10px;" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#noaccform">
                                    No
                                </button>
                            </div>
                            <div class="modal fade" id="noaccform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            Account Number Disapprove
                                            <form wire:submit.prevent="submitacc('no')">
                                                <input class="form-control form-control-sm" wire:model.defer="accremarks" placeholder="Remarks">
                                                <div style="text-align: start" class="mt-2">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </td>
                </tr>
                <tr class="">
                    <td colspan="4"> {{-- SUBMIT VERIFY --}}
                        <form id="formverify" method="POST" action="{{ route('scholarverifyendorse') }}">
                            @csrf
                            <input type="hidden" name="namescholar_id" value="{{ $scholarrequirements->scholar_id }}">
                            {{--   <input type="hidden" name="namedata_id" value="{{ $scholarrequirements->scholar_id }}"> --}}
                            <input type="hidden" name="nameprocess" id="scholarprocess" value="">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex justify-content-start align-items-center">
                                        @php
                                            $replyslipverified = \App\Models\Replyslips::where('scholar_id', $scholarrequirements->scholar_id)->first();
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
</div>
