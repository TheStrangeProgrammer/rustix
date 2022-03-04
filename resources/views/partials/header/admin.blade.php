
<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/admin.css') }}">
<div id="ADMIN" class="modal fade" tabindex="-1" aria-labelledby="ADMIN-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="ADMIN-title" class="modal-title">Admin Panel.</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body box-columns theme-bc-2">
                <div class="text-edit flex-fill col-div">
                    <div class="first-span-edit mx-auto">
                        <span class="my-auto">Player look-up</span>
                    </div>

                    <div class="total-deposited small-div text-edit " style="background-color: rgba(53,59,84,1)">
                        <input id="claim-referral" class="insert-code" type="text"  placeholder="DFH#HH">
                        <button id="update-trade-url" class="admin-button ms-auto text-edit my-auto"
                            style="margin: 6px 0">Search</button>
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
                    <div class="total-deposited text-edit justify-content-around" style="background-color: rgba(53,59,84,1)">
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">profile</button>
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">refferals</button>
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">history</button>
                    </div>
                    <div class="total-deposited text-edit justify-content-around">
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">mute</button>
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">restrict</button>
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">ceva</button>
                    </div>
                    
                    

                </div>
                <div class="text-edit flex-fill col-div" style="background-color: #0d0e14">

                    <div class="first-span-edit dif-hight mx-auto">
                        <span class="my-auto">Website actionns</span>
                    </div>
                    <div class="total-deposited text-edit justify-content-around" style="background-color: rgba(53,59,84,1)">
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">chat</button>
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">xroul.</button>
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">roul.</button>
                    </div>
                    <div class="total-deposited text-edit justify-content-around">
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">craz.</button>
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">maint.</button>
                        <button id="update-trade-url" class="admin-button text-edit my-auto"
                            style="margin: 6px 0">ceva</button>
                    </div>
                    <div class="total-deposited text-edit justify-content-around" style="background-color: rgba(53,59,84,1)">
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('js/partials/admin.js') }}"></script>
@endpush
