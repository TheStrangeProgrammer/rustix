<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/referrals.css') }}">
<div id="REFERRALS" class="modal fade" tabindex="-1" aria-labelledby="REFERRALS-title" aria-hidden="true">
    <div class="big modal-dialog modal-xl theme-bc-2">
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

                        <div class="total-referral text-edit" style="background-color: #353B54">
                            <label class="set-ref my-auto" for="fname">Your referral code:</label>
                        </div>
                        <div class="total-referral text-edit" >
                            <input id="set-referral" class="set-code" type="text"  name="fname" placeholder="DFH#HH">
                        </div>
                        <div class="total-referral text-edit" style="background-color: #353B54">
                            <button class="ref-button text-edit my-auto">Update</button>
                            <label class="ins-ref" for="lname" style="font-size: 14px">you can only change it once:</label>
                        </div>


                        <div class="total-referral">
                            <label class="ins-ref" for="lname">Claim a referral code:</label>
                        </div>
                        <div class="total-referral" style="background-color: #353B54">
                            <input id="claim-referral" class="ins-code" type="text"  placeholder="DFH#HH">
                        </div>
                        <div class="total-referral">
                            <button class="claim-button text-edit my-auto" >Claim</button>
                        </div>

                </div>
                <div class="col-list-2 text-edit ">
                    <div class="row first-span-edit mx-auto">
                        <span class="title-3 my-auto">Your earnings</span>
                    </div>
                    <div id="referrals-history" class="column-scroll scroll">
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Name">used your code</span>
                            <span class="Coins ">100 Coins</span>
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
