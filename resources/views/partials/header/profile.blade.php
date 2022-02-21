<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/profile.css') }}">
<div id="PROFILE" class="modal fade" tabindex="-1" aria-labelledby="PROFILE-title" aria-hidden="true">
    <div class="modal-dialog modal-xl theme-bc-2">
        <div class="modal-content theme-bc-2">
            <div class="modal-header theme-bc-2">
                <h5 id="ALT-title" class="modal-title">Your profile.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="box-columns theme-bc-2">
                <div class="text-edit flex-fill col-div">
                    <span class="first-span-edit">Stats</span>
                    <div class="total-deposited text-edit" style="background-color: rgba(53,59,84,1)">
                        <span class="p-2">Total Deposited:</span>
                        <span class="ms-auto p-2">$<span id="total-deposited">653.44</span></span>
                    </div>
                    <div class="total-deposited text-edit">
                        <span class="p-2">Total Gambled:</span>
                        <span id="total-gambled" class="ms-auto p-2">$<span id="total-gambled">953.66</span></span>
                    </div>
                    <div class="total-deposited text-edit p0" style="background-color: rgba(53,59,84,1)">
                        <span class="p-2 ">Profit:</span>
                        <span id="profit" class="ms-auto p-2">
                            -321,88
                        </span>
                    </div>
                    <span class="first-span-edit" style="padding: 2.625rem 0">Setting</span>
                    <div class="d-flex justify-content-stretch align-items-center total-deposited text-edit" style="background-color: rgba(53,59,84,1)">
                        <span class="p-2">Trade URL:</span>
                        <input id="trade-token" class="form-control flex-fill me-1">
                        <button class="profile-button ms-auto text-edit">Update</button>
                    </div>
                    <div class="total-deposited text-edit" >
                        <span class="p-2">Help me find my steam trade link</span>
                        <a class="profile-button ms-auto text-edit" target="_blank"
                            href="http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url">Click Here</a>
                    </div>
                    <div class="total-deposited" style="background-color: rgba(53,59,84,1)">
                        <span class="p-2">My steam trade offers</span>
                        <a class="profile-button ms-auto text-edit" target="_blank"
                            href="https://steamcommunity.com/id/me/tradeoffers">Trade Offers</a>
                    </div>

                    <div class="flex-fill py-3 avatar-edit">
                        <img src="{{ Auth::user()->avatar }}">
                        <span class="text-edit">MOD</span>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                </div>
                <div class="text-edit flex-fill col-div" style="background-color: #0d0e14">
                    <span class="first-span-edit">Betting History</span>
                    <div class="scroll">
                        <div class="total-deposited text-edit" style="background-color: #00C74D">
                            <span class="p-2">Won 1337 coins:</span>
                            <span class="ms-auto p-2">x-roulette</span>
                            <span class="ms-auto p-2">02:44am</span>
                        </div>
                        <div class="ScrollStyle">

                            <div class="total-deposited  text-edit" style="background-color: #00C74D">
                                <span class="p-2">Won 1337 coins:</span>
                                <span class="ms-auto p-2">roulette</span>
                                <span class="ms-auto p-2">03:14pm</span>
                            </div>
                            <div class="total-deposited text-edit" style="background-color: rgba(175,41,41,1)">
                                <span class="p-2">Lost 1337 coins:</span>
                                <span class="ms-auto p-2">crazytime</span>
                                <span class="ms-auto p-2">10-03-22</span>
                            </div>
                            <div class="total-deposited text-edit" style="background-color: #00C74D">
                                <span class="p-2">Won 1337 coins:</span>
                                <span class="ms-auto p-2">x-roulette</span>
                                <span class="ms-auto p-2">02:44am</span>
                            </div>
                            <div class="total-deposited text-edit" style="background-color: rgba(175,41,41,1)">
                                <span class="p-2">Lost 1337 coins:</span>
                                <span class="ms-auto p-2">x-roulette</span>
                                <span class="ms-auto p-2">02:44am</span>
                            </div>
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
