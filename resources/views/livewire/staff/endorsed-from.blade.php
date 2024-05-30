<div>
    <button type="button" class="btn rounded-pill" data-bs-toggle="modal" style="background-color: #0D47A1; color: snow;" data-bs-target="#endorsedmodal">
        Endorsed
    </button>
    {{--  @dd($getprogram); --}}
    {{-- ENDORSED MODAL --}}
    <div class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static" id="endorsedmodal" tabindex="-1" aria-labelledby="endorsedmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="endorsedmodalLabel">Endorsed from other region</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body ">
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">SPASNo:</span>
                                    <input type="text" class="form-control" wire:model.defer="spasno" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Firstname:</span>
                                    <input required type="text" class="form-control" wire:model.defer="Firstname" name="Firstname" aria-label="Firstname" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Middlename:</span>
                                    <input required type="text" class="form-control" wire:model.defer="Middlename" name="Middlename" aria-label="Middlename" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Surname:</span>
                                    <input required type="text" class="form-control" wire:model.defer="Surname" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Birthdate:</span>
                                    <input required type="text" class="form-control" wire:model.defer="Birthdate" name="Birthdate" aria-label="Birthdate" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Program:</span>
                                    <select required wire:model.defer="program" id="program" class="form-control">
                                        <option value="">Select Program</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}">{{ $program->progname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Strand:</span>
                                    <select required wire:model.defer="strand" id="" class="form-control">
                                        <option value="">Select Strand</option>
                                        <option value="{{ 'NON-STEM' }}">NON-STEM</option>
                                        <option value="{{ 'STEM' }}">STEM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Email:</span>
                                    <input required type="text" class="form-control" placeholder="" wire:model.defer="Email" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">LVDCaccount:</span>
                                    <input required type="text" class="form-control" placeholder="" wire:model.defer="LVDCaccount" aria-label="Surname" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">AppID:</span>
                                    <input required type="text" class="form-control" placeholder="" wire:model.defer="appid" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Gender:</span>
                                    <select required id="genderSelect" wire:model.defer="gender" id="" class="form-control">
                                        <option value="">Select Gender</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}">{{ $gender->gendername }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Mobile:</span>
                                    <input required type="text" class="form-control" placeholder="" wire:model.defer="mobile" aria-describedby="basic-addon1" id="mobile">

                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Year:</span>
                                    <input type="text" class="form-control" placeholder="Startyear" wire:model.defer="year" aria-describedby="basic-addon1" id="mobile">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button id="closemodal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const numericInput = document.getElementById('mobile');
        numericInput.addEventListener('keypress', function(event) {
            if (!/[0-9]/.test(String.fromCharCode(event.which))) {
                event.preventDefault();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('endorsedmodal'), {
                keyboard: false, // Disables closing with ESC key
                backdrop: false // Keeps the backdrop static
            });
        });
    </script>
