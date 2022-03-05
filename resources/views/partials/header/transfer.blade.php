<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/transfer.css') }}">
<div id="TRANSFER" class="modal fade" tabindex="-1" aria-labelledby="TRANSFER-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="TRANSFER-title" class="modal-title">Your transfer.</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center">

            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('js/partials/transfer.js') }}"></script>
@endpush
