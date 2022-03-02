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

                    <div class="col-set text-edit">
                        <div class="set-ref-box">
                            <label class="set-ref" for="fname">Your referral code:</label>
                        </div>
                        <div class="set-code-box">
                            <input class="set-code" type="text" id="fname" name="fname">
                        </div>
                        <div class="set-codeb-box">
                            <input class="set-codeb" style="background-color:#00C74D" type="submit" value="Update">
                        </div>
                    </div>

                    <div class="col-ins text-edit">
                        <div class="ins-ref-box">
                            <label class="ins-ref" for="lname">Claim a referral code:</label>
                        </div>
                        <div class="ins-code-box">
                            <input class="ins-code" type="text" id="lname" name="lname">
                        </div>
                        <div class="ins-codeb-box">
                            <input class="ins-codeb" style="background-color:#00C74D" type="submit" value="Claim">
                        </div>
                    </div>
                </div>
                <div class="col-list-2 text-edit " style="background-color: #1A1D29">
                    <div class="row first-span-edit mx-auto">
                        <span class="title-3 my-auto">Your earnings</span>
                    </div>
                    <div class="column-scroll scroll">
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>

                        <div class="ref-list  text-edit">
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>

                        <div class="ref-list  text-edit" >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>

                        <div class="ref-list  text-edit" >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>

                        <div class="ref-list  text-edit" >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Coins ">100 Coins</span>
                        </div>

                        <div class="ref-list  text-edit" >
                            <span class="Name">Nume Referral</span>
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
