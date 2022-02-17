<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/deposit.css') }}">
<div id="DEPOSIT" class="modal fade" tabindex="-1" aria-labelledby="DEPOSIT-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header deposit-h-edit">
                <h5 id="ALT-title" class="modal-title mx-auto">Your deposit.</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="flex-fill h-100">
                <div class="flex-fill deposit-wrapper">
                    <div class="d-flex flex-wrap deposit">

                    </div>
                </div>
                <div class="d-flex container-fluid  fw-bold deposit-sell p-2" style="background-color: #141620">
                    <div class="d-flex me-auto ps-5">
                        <form class="d-inline" method="POST" action="{{ URL::route('depositItems') }}">
                         @csrf
                            <span class="first-text">You have selected&nbsp<span class="span-13">13&nbsp</span></span>  
                      
                            <span class="first-text">items worth&nbsp<span id="total">$143.66&nbsp</span></span>
                            <input id="item-list" class="d-none" type="text" name="itemList">
                    </div>
                            <input class="text-white px-4 py-2 me-5" style="background-color:#00C74D " id="submit-item-list"
                            type="submit" value="trade for 143.66 coins">
                        </form>
                    
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('js/partials/deposit.js') }}"></script>
@endpush
