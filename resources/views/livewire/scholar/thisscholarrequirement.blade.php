<div class="">


    @if ($getaccnumber->ac_status == 2 || $getaccnumber->ac_status == 2 || $getcor->cor_status == 2 || $getProspectus->p_status == 2 || $getSO->so_status == 2 || $getIS->inf_status == 2 || $getIS->inf_status == 2 || $getSA->sa_status == 2)
        <div style="padding: 10px;" class="card mt-3">
            <div class="table-responsive">
                <table class="table table-bordered" style="text-align: center; border: 1px solid rgb(223, 223, 223);">
                    <thead class="">
                        <tr class="">
                            <th style="width: 12rem" class="">Requirement</th>
                            <th style="width: 12rem" class="">Remarks</th>
                            <th style="width: 5rem" class="">View</th>
                            <th style="width: 12rem" class="">Reupload</th>
                            <th style="width: 4rem" class="">Submit</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <div class="">

                            @if ($getaccnumber->ac_status == 2)
                                <tr>
                                    <td class="">Account Number</td>
                                    <td class="">{{ $getaccnumber->ac_remarks }}</td>
                                    <td class=""><a class="btn btn-primary btn-sm" target="_blank" href="{{ asset($getaccnumber->accnumber_name) }}"><i class="fas fa-eye"></i></a></td>
                                    <td class="">
                                        <input type="file" wire.model="account" required class="form-control">
                                        @if ($errors->has('account'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('account') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class=""><button class="btn btn-outline-success" wire:click.prevent="save">Submit</button></td>
                                </tr>
                            @endif
                            {{--  @if ($getcor->cor_status == 2)
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
                            @endif --}}


                        </div>

                    </tbody>

                </table>
            </div>
        </div>
    @else
    @endif
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
