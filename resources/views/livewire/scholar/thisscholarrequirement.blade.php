<div class="">
    @if (in_array(2, [$getaccnumber->ac_status, $getcor->cor_status, $getProspectus->p_status, $getSO->so_status, $getIS->inf_status, $getSA->sa_status]))
        <div style="padding: 10px;" class="card mt-3">
            <div class="table-responsive">
                <table class="table table-bordered" style="text-align: center; border: 1px solid rgb(223, 223, 223);">
                    <form wire:subtmit.prevent="submitUploads">
                        <thead class="">
                            <tr class="">
                                <th style="width: 12rem" class="">Requirement</th>
                                <th style="width: 12rem" class="">Remarks</th>
                                <th style="width: 6rem" class="">View</th>
                                <th style="width: 6rem" class="">Reupload</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @if ($getaccnumber->ac_status == 2)
                                <tr>
                                    <td class="">Account Number</td>
                                    <td class="">{{ $getaccnumber->ac_remarks }}</td>
                                    <td class=""><a class="btn btn-primary btn-sm" target="_blank" href="{{ asset($getaccnumber->accnumber_name) }}"><i class="fas fa-eye"></i></a></td>
                                    <td class=""><input type="file" wire.model="setaccnumber" required class="form-control"></td>
                                </tr>
                            @endif
                            @if ($getcor->cor_status == 2)
                                <tr>
                                    <td class="">COR</td>
                                    <td class="">{{ $getcor->cor1_remarks }}</td>
                                    <td class=""><a class="btn btn-primary btn-sm" target="_blank" href="{{ asset($getcor->cor_name) }}"><i class="fas fa-eye"></i></a></td>
                                    <td class=""><input type="file" wire.model="setcor" class="form-control" required></td>
                                </tr>
                            @endif
                            @if ($getProspectus->p_status == 2)
                                <tr>
                                    <td class="">Prospectus</td>
                                    <td class="">{{ $getProspectus->p_remarks }}</td>
                                    <td class=""><a class="btn btn-primary btn-sm" target="_blank" href="{{ asset($getProspectus->prospectus_name) }}"><i class="fas fa-eye"></i></a></td>
                                    <td class=""><input type="file" wire.model="setprospectus" class="form-control" required></td>
                                </tr>
                            @endif
                            @if ($getSO->so_status == 2)
                                <tr>
                                    <td class="">Scholar's Oath</td>
                                    <td class="">{{ $getSO->so_remarks }}</td>
                                    <td class=""><a class="btn btn-primary btn-sm" target="_blank" href="{{ asset($getSO->scholaroath_name) }}"><i class="fas fa-eye"></i></a></td>
                                    <td class=""><input type="file" wire.model="setschol_oath" class="form-control" required></td>
                                </tr>
                            @endif
                            @if ($getIS->inf_status == 2)
                                <tr>
                                    <td class="">Information Sheet</td>
                                    <td class="">{{ $getIS->inf_remarks }}</td>
                                    <td class=""><a class="btn btn-primary btn-sm" target="_blank" href="{{ asset($getIS->infosheet_name) }}"><i class="fas fa-eye"></i></a></td>
                                    <td class=""><input type="file" wire.model="setschol_is" class="form-control" required></td>
                                </tr>
                            @endif
                            @if ($getSA->sa_status == 2)
                                <tr>
                                    <td class="">Scholarship Agreement</td>
                                    <td class="">{{ $getSA->sa_remarks }}</td>
                                    <td class=""><a class="btn btn-primary btn-sm" target="_blank" href="{{ asset($getSA->scholarshipagreement_name) }}"><i class="fas fa-eye"></i></a></td>
                                    <td class=""><input type="file" wire.model="setschol_sa" class="form-control" required></td>
                                </tr>
                            @endif
                            <tr class="">
                                <td colspan="4" type="submit" class=""><button class="btn btn-success btn-sm">Submit</button></td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>
    @endif
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
