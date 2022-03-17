<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/coinflip.css') }}">
<div id="COINFLIP" class="modal fade" tabindex="-1" aria-labelledby="DEPOSIT-title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-coinflip">
        <div class="modal-content modal-content-coinflip h-100">
            <div class="modal-header modal-header-coinflip">
                <h5 id="DEPOSIT-title" class="modal-title ">COINFLIP</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-coinflip justify-content-center">
                <div class="border-grad"></div>
                <div class="parent">
                    <div id="area" class="area"></div>
                    <div class="area cover d-flex justify-content-center">
                        <div class="first-circle">
                            <span>X</span><input type="number" value="1">
                        </div>
                        <div class="second-circle">
                            <span>X</span><input type="number" value="500">
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('js/partials/coinflip.js') }}"></script>
@endpush
