<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/inventory.css') }}">
<div id="DEPOSIT" class="modal fade" tabindex="-1" aria-labelledby="DEPOSIT-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="ALT-title" class="modal-title">Your inventory.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex flex-column flex-fill h-100">
                <div class="flex-fill inventory-wrapper">
                    <div class="d-flex flex-wrap inventory">

                    </div>
                </div>
                <div class="d-flex container-fluid  fw-bold inventory-sell p-2" style="background-color: #141620">
                    <form class="d-inline mx-auto" method="POST" action="{{ URL::route('depositItems') }}">
                        @csrf
                        <p class="text-white d-inline me-5">Total: <span id="total">0</span></p>
                        <input id="item-list" class="d-none" type="text" name="itemList">
                        <input class="text-white px-4 py-2" style="background-color:#14DB1A " id="submit-item-list"
                            type="submit" value="SELL">
                    </form>
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('js/partials/inventory.js') }}"></script>
@endpush
