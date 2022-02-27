<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/referrals.css') }}">
<div id="REFERRALS" class="modal fade" tabindex="-1" aria-labelledby="REFERRALS-title" aria-hidden="true">
    <div class="modal-dialog modal-xl theme-bc-2 ref-title">
        <div class="modal-content theme-bc-2">
            <div class="modal-header theme-bc-4">
                <h5 id="REFERRALS-title" class="modal-title">Referrals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body theme-bc-2">
            </div>
        </div>
    </div>
    <div class="modal-body ref-columns theme-bc-2">
        <div class="text-edit flex-fill col-div">
            <div class="first-span-edit mx-auto">
                <span class="my-auto"> </span>
            </div>

            <div class="flex-container justify-content-between" style="background-color: #353B54">
                <div class="column col-set text-edit">
                    <label class="set-ref" for="fname">Set your referral code:</label>
                    <input class="set-code" type="text" id="fname" name="fname">
                    <input class="set-codeb" type="submit" value="Set your referral code">

                </div>
                <div class="column col-ins text-edit">
                    <label class="ins-ref" for="lname">Enter referral code:</label>
                    <input class="ins-code" type="text" id="lname" name="lname">
                    <input class="ins-codeb" type="submit" value="Enter referral code">
                </div>  
            </div>
        

        </div>
        <div class="text-edit flex-fill col-div" style="background-color: #1A1D29">

            <div class="first-span-edit mx-auto">
                <span class="my-auto">Referrals List</span>
            </div>
            <div id="bet-history" class="scroll">
                <div class="total-deposited2 text-edit ref-text" style="background-color: #353B54;">
                    <span class="Name">Nume Referral</span>
                    <span class="Time ">Timp Online</span>
                </div>


                    <div class="total-deposited2  text-edit" style="background-color: #141620">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #353B54">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #141620">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #353B54">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #141620">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #353B54">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #141620">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #353B54">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #141620">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>

                    <div class="total-deposited2 text-edit" style="background-color: #353B54">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #141620">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>

                    <div class="total-deposited2 text-edit" style="background-color: #353B54">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>
                    <div class="total-deposited2 text-edit" style="background-color: #141620">
                        <span class="Name">Nume Referral</span>
                        <span class="Time ">Timp Online</span>
                    </div>


            </div>


        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('js/partials/referrals.js') }}"></script>
@endpush
