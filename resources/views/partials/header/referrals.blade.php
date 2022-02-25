<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/referrals.css') }}">
<div id="REFERRALS" class="modal fade" tabindex="-1" aria-labelledby="REFERRALS-title" aria-hidden="true">
    <div class="modal-dialog modal-xl theme-bc-2">
        <div class="modal-content theme-bc-2">
            <div class="modal-header theme-bc-4">
                <h5 id="REFERRALS-title" class="modal-title">Your referrals.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body box-columns theme-bc-2">
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('js/partials/referrals.js') }}"></script>
@endpush
