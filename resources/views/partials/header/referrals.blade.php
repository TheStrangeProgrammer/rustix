<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/referrals.css') }}">
<div id="REFERRALS" class="modal fade" tabindex="-1" aria-labelledby="REFERRALS-title" aria-hidden="true">
    <div class="big modal-dialog modal-dialog-referrals theme-bc-2">
        <div class="col-cont modal-content modal-content-referrals theme-bc-2">
            <div class="title modal-header theme-bc-4">
                <h5 id="PROFILE-title" class="modal-title">Referrals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex flex-row w-100 justify-content-between div-info-top">
                <div class="d-flex flex-column text-center div-second-top">
                    <span style="font-size: 1.36666666rem">INFORM OTHERS</span>
                    <span class="second-span-top">Tell your friends about RustBet by sharing your referral link / code.</span>
                </div>
                <div class="d-flex flex-column div-second-top">
                    <span style="font-size: 1.36666666rem">MAKE PROFIT</span>
                    <span class="second-span-top">Earn up to 10% of our house edge on all your referred users’ bets.</span>
                </div>
                <div class="d-flex flex-column div-second-top">
                    <span style="font-size: 1.36666666rem">WITHDRAW SKINS</span>
                    <span class="second-span-top">Use your balance to withdraw skins from the Referral Shop.</span>
                </div>

            </div>
            <div class="row-col-list modal-body theme-bc-2" style="margin: 0 3%">
                <div class="col-list-1">

                        <div class="total-referral div-text-ref" style="margin-top: 2%">
                            <label class="set-ref my-auto" for="fname">SET CUSTOM REFERRAL CODE</label>
                        </div>
                        <div class="total-referral" >
                            <input id="set-referral" class="set-code" type="text"  name="fname">
                            <div class="d-flex " style="min-width: 85px">
                                <button class="claim-button  text-edit my-auto">Apply</button>
                            </div>
                        </div>
                        
                        <div class="total-referral div-text-ref">
                            <label class="ins-ref" for="lname">YOUR REFERRAL LINK</label>
                        </div>
                        <div class="total-referral" style="padding-bottom: 2%">
                            <input id="claim-referral" class="set-code" type="text">
                            <div class="d-flex" style="min-width: 85px">
                                <button class="claim-button text-edit my-auto" style="background-color: #505157">Copy</button>
                            </div>
                        </div>
                        

                </div>
                <div class="col-list-2 text-edit ">
                    <div class="total-referral div-text-ref" style="margin-top: 2%">
                        <label class="set-ref my-auto" for="fname">BALANCE</label>
                    </div>
                    <div class="total-referral" >
                        <input id="set-referral" readonly="readonly" value="$0.00" class="set-code w-100" type="text" name="fname" style="color: #00C74D">
                        
                    </div>
                    
                    <div class="total-referral div-text-ref">
                        <label class="ins-ref" for="lname">TOTAL EARNED (REFERRED USERS: 0)</label>
                    </div>
                    <div class="total-referral" style="padding-bottom: 2%">
                        <input id="claim-referral" readonly="readonly" value="$0.00" class="set-code w-100" type="text" name="fname">
                        
                    </div>


                </div>


    <!--

                <div class="col-list-2 text-edit ">
                    <div class="row first-span-edit mx-auto">
                        <span class="title-3 my-auto">Your earnings</span>
                    </div>
                    <div id="referrals-history" class="column-scroll scroll">
                        <div class="ref-list text-edit  " >
                            <span class="Name">Nume Referral</span>
                            <span class="Name">used your code</span>
                            <span class="Coins">100 Coins</span>
                        </div>


                    </div>


                </div>  -->          
            </div>
            <div class="d-flex flex-column" style="color: #999">
                <div class="first-div-btn-ref">
                    <div class="div-btn-ref">
                        <button class="referrals-button my-auto" style="border-right: 1px solid #181B26">1+REFERRALS</button>
                    </div>
                    <div class="div-btn-ref">
                        <button class="referrals-button my-auto" style="border-right: 1px solid #181B26">25+REFERRALS</button>
                    </div>
                    <div class="div-btn-ref" style="min-width: 85px">
                        <button class="referrals-button my-auto">100+REFERRALS</button>
                    </div>
                </div>
                <div class="d-flex flex-column text-center" style="margin: 0 3%">
                    <div class="d-flex flex-row div-line" style="margin-top: 0">
                        <span class="first-span-list">JACKPOT</span>
                        <span class="second-span-list">% of the commision we take when a referred user wins</span>
                        <span class="third-span-list">5.00%</span>
                    </div>
                    <div class="d-flex flex-row div-line" style="background-color: #202433">
                        <span class="first-span-list">COINFLIP </span>
                        <span class="second-span-list">% of the commision we take when your referred user wins</span>
                        <span class="third-span-list">5.00%</span>
                    </div>
                    <div class="d-flex flex-row div-line">
                        <span class="first-span-list">UPGRADE </span>
                        <span class="second-span-list">% of the total bet by a referred user</span>
                        <span class="third-span-list">3.00%</span>
                    </div>
                </div>
                <div class="referral-store flex-column">
                    <div class="d-flex first-referral-store">
                        <div class="d-flex second-referral-store">
                            <span class="ref-store-text">Referral Store</span>
                            <span class=" selected-items-ref" style="margin-left: 3%">SELECTED: </span>
                            <span class="value-ref" style="margin-left: 1%">$0.00</span>
                            <span class="selected-items-ref" style="margin-left: 2%">0 items</span>
                        </div>
                            <div class="right-price" >
                                <div class="div-btn-price">
                                    <button class="referrals-button my-auto" style="border-right: 1px solid #181B26">Purchase</button>
                                </div>
                                <div class="div-btn-price">
                                    <button class="referrals-button my-auto" style="border-right: 1px solid #181B26">$>0</button>
                                </div>
                                <div class="div-btn-price" style="min-width: 85px">
                                    <button class="referrals-button my-auto">Price</button>
                                </div>
                            </div>
                            
                    </div>
                    <div class="form-outline">
                        <input type="search" id="form1" class="form-control" placeholder="Search items..." aria-label="Search" />
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('js/partials/referrals.js') }}"></script>
@endpush
