<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/crypto.css') }}">
<div id="CRYPTO" class="modal fade" tabindex="-1" aria-labelledby="CRYPTO-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="CRYPTO-title" class="modal-title">Your crypto.</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center">

            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('js/partials/crypto.js') }}"></script>
@endpush
