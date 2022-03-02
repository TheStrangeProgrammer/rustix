<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/referrals.css') }}">
<div id="REFERRALS" class="modal fade" tabindex="-1" aria-labelledby="REFERRALS-title" aria-hidden="true">
    <div class="container modal-dialog modal-xl theme-bc-2">
        <div class="col-cont modal-content theme-bc-2">
            <div class="title modal-header theme-bc-4">
                <h5 id="PROFILE-title" class="modal-title">Refferals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <div class="row-col-list modal-body theme-bc-2">
                <div class="col-list-1 text-edit">
                    <div class="first-span-edit title-2">
                        <span class="my-auto">Settings</span>
                    </div>

                    <div class="col-set text-edit">
                        <label class="set-ref" for="fname">Your referral code:</label>
                        <input class="set-code" type="text" id="fname" name="fname">
                        <input class="set-codeb" type="submit" value="Update">
                    </div>

                    <div class="col-ins text-edit">
                        <label class="ins-ref" for="lname">Claim a referral code:</label>
                        <input class="ins-code" type="text" id="lname" name="lname">
                        <input class="ins-codeb" type="submit" value="Claim">
                    </div>
                </div>
                <div class="col-list-2 text-edit " style="background-color: #1A1D29">
                    <div class="row first-span-edit mx-auto">
                        <span class="title-3 my-auto">Referrals List</span>
                    </div>
                    <div class="column-scroll scroll">
                        <div class="ref-list text-edit  " style="background-color: #353B54;">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>

                        <div class="ref-list  text-edit" style="background-color: #141620">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>
                        <div class="ref-list text-edit  " style="background-color: #353B54;">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>
                        <div class="ref-list text-edit  " style="background-color: #141620;">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>

                        <div class="ref-list  text-edit" style="background-color: #353B54">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>
                        <div class="ref-list text-edit  " style="background-color: #141620;">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>
                        <div class="ref-list text-edit  " style="background-color: #353B54;">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>

                        <div class="ref-list  text-edit" style="background-color: #141620">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>
                        <div class="ref-list text-edit  " style="background-color: #353B54;">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>
                        <div class="ref-list text-edit  " style="background-color: #141620;">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>

                        <div class="ref-list  text-edit" style="background-color: #353B54">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>
                        <div class="ref-list text-edit  " style="background-color: #141620;">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>
                        <div class="ref-list text-edit  " style="background-color: #353B54;">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>

                        <div class="ref-list  text-edit" style="background-color: #141620">
                            <span class="Name">Nume Referral</span>
                            <span class="Time ">Timp Online</span>
                        </div>
                    </div>


                </div>
            </div>
            
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('js/partials/referrals.js') }}"></script>
@endpush
