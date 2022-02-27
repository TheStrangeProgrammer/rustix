<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/withdraw.css') }}">
<div id="WITHDRAW" class="modal fade" tabindex="-1" aria-labelledby="WITHDRAW-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="WITHDRAW-title" class="modal-title">Your withdraw.</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="flex-fill withdraw-wrapper">
                    <div class="d-flex flex-wrap withdraw">

                    </div>
                </div>
                <div class="withdraw-sell justify-content-between flex-wrap align-items-center" style="background-color: #141620">
                    <div class="d-flex ">
                        <span class="first-text">You have selected<span id="withdraw-count">13</span></span>
                        <span class="first-text">items worth<span id="withdraw-total"> $143.66</span></span>
                    </div>
                    <div class="submit-btn">
                        <button id="submit-withdraw-item-list" class="text-white" id="submit-item-list"
                        type="submit">trade for <span id="withdraw-coins"> $143.66</span> coins</button>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('js/partials/withdraw.js') }}"></script>
@endpush
