<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/profile.css') }}">
<div id="PROFILE" class="modal fade" tabindex="-1" aria-labelledby="PROFILE-title" aria-hidden="true">
    <div class="modal-dialog modal-xl theme-bc-2">
        <div class="modal-content theme-bc-2">
            <div class="modal-header theme-bc-4">
                <h5 id="PROFILE-title" class="modal-title">Your profile.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body box-columns theme-bc-2">
                <div class="text-edit flex-fill col-div">
                    <div class="first-span-edit mx-auto">
                        <span class="my-auto">Stats</span>
                    </div>

                    <div class="total-deposited text-edit" style="background-color: #2a2f43">
                        <span class="span-profile">Total Deposited:</span>
                        <span class="dollar-bet">$<span id="total-deposited">653.44</span></span>
                    </div>
                    <div class="total-deposited text-edit">
                        <span class="span-profile">Total Gambled:</span>
                        <span id="total-gambled" class="ms-auto py-2 my-auto">$<span
                                id="total-gambled">953.66</span></span>
                    </div>
                    <div class="total-deposited text-edit p0" style="background-color: #2a2f43">
                        <span class="span-profile">Profit:</span>
                        <span id="profit" class="ms-auto py-2 my-auto">
                            -321,88
                        </span>
                    </div>
                    <div class="total-deposited-settings text-edit">
                        <span class="edit-setting my-auto">Setting</span>
                    </div>
                    <div class="d-flex justify-content-stretch align-items-center total-deposited text-edit"
                        style="background-color: #2a2f43">
                        <span class="span-profile">Trade URL:</span>
                    </div>
                    <div class="total-deposited text-edit form-inp">
                        <input id="trade-token" class="form-control flex-fill my-auto"
                            placeholder="https://steamcommunity.com/tradeoffer/new/?a">
                    </div>
                    <div class="total-deposited text-edit " style="background-color: #2a2f43">
                        <span class="span-help span-profile">Help me find my steam <a class="text-edit"
                                style="margin: 0 3.5px;font-weight:bolder" target="_blank"
                                href="http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url">trade
                                link</a></span>
                        <button id="update-trade-url" class="profile-button ms-auto text-edit my-auto"
                            style="margin: 6px 0">Update</button>

                    </div>

                    <div class="d-flex flex-fill avatar-edit">
                        <img src="{{ Auth::user()->avatar }}">
                        <div class="d-flex text-edit justify-content-center align-items-center">
                            <span>MOD</span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="my-auto align-self-center"
                                style="font-size: 25px">{{ Auth::user()->name }}</span>
                        </div>
                    </div>

                </div>
                <div class="text-edit flex-fill col-div" style="background-color: #181b26">

                    <div class="first-span-edit mx-auto">
                        <span class="my-auto">Betting History</span>
                    </div>
                    <div id="bet-history" class="scroll">
                        <div class="total-deposited2 text-edit" style="background-color: #00C74D">
                            <span>Won 1337 coins:</span>
                            <span class="ms-auto ">x-roulette</span>
                            <span class="ms-auto ">02:44am</span>
                        </div>


                        <div class="total-deposited2  text-edit" style="background-color: #00C74D">
                            <span>Won 1337 coins:</span>
                            <span class="ms-auto">roulette</span>
                            <span class="ms-auto">03:14pm</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">crazytime</span>
                            <span class="ms-auto">10-03-22</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #00C74D">
                            <span>Won 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>

                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>

                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>
                        <div class="total-deposited2 text-edit" style="background-color: #AF2929">
                            <span>Lost 1337 coins:</span>
                            <span class="ms-auto">x-roulette</span>
                            <span class="ms-auto">02:44am</span>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('js/partials/profile.js') }}"></script>
@endpush
