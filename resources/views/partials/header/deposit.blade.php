<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/deposit.css') }}">
<div id="DEPOSIT" class="modal fade" tabindex="-1" aria-labelledby="DEPOSIT-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="DEPOSIT-title" class="modal-title">Your deposit.</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center">
                <div class="flex-fill deposit-wrapper ">
                    <div class="d-flex flex-wrap deposit justify-content-between">

                    </div>
                </div>
                <div class="deposit-sell justify-content-between flex-wrap" style="background-color: #141620">
                    <div class="d-flex ">
                        <span class="first-text">You have selected<span id="deposit-count">13</span></span>
                        <span class="first-text">items worth<span id="deposit-total"> $143.66</span></span>

                    </div>
                    <div class="submit-btn">
                        <button id="submit-deposit-item-list" class="text-white" id="submit-item-list"
                        type="submit"><span class="d-none" id="deposit-coins"></span>DEPOSIT</button>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('js/partials/deposit.js') }}"></script>
@endpush
