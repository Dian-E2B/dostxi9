<div class="">


    {{-- @if ($getaccnumber->ac_status == 2 || $getaccnumber->ac_status == 2 || $getcor->cor_status == 2 || $getProspectus->p_status == 2 || $getSO->so_status == 2 || $getIS->inf_status == 2 || $getIS->inf_status == 2 || $getSA->sa_status == 2) --}}
    <div id="requirementdiv" style="padding: 10px; display:none" class="card mt-3">
        <div class="table-responsive">
            <table class="table table-bordered" style="text-align: center; border: 1px solid rgb(223, 223, 223);">
                <thead class="">
                    <tr class="">
                        <th style="width: 12rem" class="">Requirement</th>
                        <th style="width: 12rem" class="">Remarks</th>
                        <th style="width: 5rem" class="">View</th>
                        <th style="width: 12rem" class="">Reupload</th>
                        <th style="width: 5rem" class="">Submit</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr id="accnumbertr" style="display: none">
                        <td class="">Account Number</td>
                        <td id="getaccremarks" class=""></td>
                        <td class=""><a id="accnumberlink" target="_blank" class="btn btn-primary btn-sm">View</a></td>
                        <form id="accform" enctype="multipart/form-data">
                            <td class="">
                                <input type="file" name="accnumberfile" required class="form-control">
                            </td>
                            <td class=""><button type="button" class="btn btn-outline-success " onclick="setaccnumber()">Submit</button></td>
                        </form>
                    </tr>
                    <tr id="corfirsttr" style="display: none">
                        <td class="">Certificate Of Registration</td>
                        <td id="getcorremarks" class=""></td>
                        <td class=""><a id="corffirstlink" target="_blank" class="btn btn-primary btn-sm">View</a></td>
                        <form id="corfirstform" enctype="multipart/form-data">
                            <td class="">
                                <input type="file" name="corfirstfile" required class="form-control">
                            </td>
                            <td class=""><button type="button" class="btn btn-outline-success " onclick="setcorfirst()">Submit</button></td>
                        </form>
                    </tr>
                    <tr id="prospectustr" style="display: none">
                        <td class="">Prospectus</td>
                        <td id="getprospectusremarks" class=""></td>
                        <td class=""><a id="prospectuslink" target="_blank" class="btn btn-primary btn-sm">View</a></td>
                        <form id="prospectusform" enctype="multipart/form-data">
                            <td class="">
                                <input type="file" name="prospectusfile" required class="form-control">
                            </td>
                            <td class=""><button type="button" class="btn btn-outline-success " onclick="setprospectus()">Submit</button></td>
                        </form>
                    </tr>
                    <tr id="scholaroathtr" style="display: none">
                        <td class="">Scholar's Oath</td>
                        <td id="getscholaroathremarks" class=""></td>
                        <td class=""><a id="scholaroathlink" target="_blank" class="btn btn-primary btn-sm">View</a></td>
                        <form id="scholaroathForm" enctype="multipart/form-data">
                            <td class="">
                                <input type="file" name="scholaroathFile" required class="form-control">
                            </td>
                            <td class=""><button type="button" class="btn btn-outline-success " onclick="setscholaroath()">Submit</button></td>
                        </form>
                    </tr>
                    <tr id="infotr" style="display: none">
                        <td class="">Information Sheet</td>
                        <td id="inforemarks" class=""></td>
                        <td class=""><a id="infolink" target="_blank" class="btn btn-primary btn-sm">View</a></td>
                        <form id="infosheetForm" enctype="multipart/form-data">
                            <td class="">
                                <input type="file" name="infosheetFile" required class="form-control">
                            </td>
                            <td class=""><button type="button" class="btn btn-outline-success " onclick="setinfosheet()">Submit</button></td>
                        </form>
                    </tr>
                    <tr id="scholaragreementtr" style="display: none">
                        <td class="">Scholarship Agreement</td>
                        <td id="scholaragreementremarks" class=""></td>
                        <td class=""><a id="scholaragreementLink" target="_blank" class="btn btn-primary btn-sm">View</a></td>
                        <form id="scholaragreementForm" enctype="multipart/form-data">
                            <td class="">
                                <input type="file" name="scholaragreementFile" required class="form-control">
                            </td>
                            <td class=""><button type="button" class="btn btn-outline-success " onclick="setscholaragreement()">Submit</button></td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
