
<link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/admin.css') }}">
<div id="ADMIN" class="modal fade" tabindex="-1" aria-labelledby="ADMIN-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="ADMIN-title" class="modal-title">Your admin.</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center">

            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('js/layouts/admin.js') }}"></script>
@endpush
