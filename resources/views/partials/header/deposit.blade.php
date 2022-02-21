<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/deposit.css') }}">
<div id="DEPOSIT" class="modal fade" tabindex="-1" aria-labelledby="DEPOSIT-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header deposit-h-edit">
                <h5 id="ALT-title" class="modal-title mx-auto">Your deposit.</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="h-100">
                <div class="flex-fill deposit-wrapper">
                    <div class="d-flex flex-wrap deposit">

                    </div>
                </div>
                <div class="deposit-sell" style="background-color: #141620">

                    <span class="first-text">You have selected<span id="count"> 13 </span></span>
                    <span class="first-text">items worth<span id="total"> $143.66</span></span>
                    <input id="item-list" class="d-none" type="text" name="itemList">
                    <button class="text-white px-4 py-2 me-5" style="background-color:#00C74D" id="submit-item-list"
                        type="submit">trade for <span id="coins"> $143.66</span> coins</button>


                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('js/partials/deposit.js') }}"></script>
@endpush
