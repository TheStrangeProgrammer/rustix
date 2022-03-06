<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/crypto.css') }}">
<div id="CRYPTO" class="modal fade" tabindex="-1" aria-labelledby="CRYPTO-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="CRYPTO-title" class="modal-title">Your crypto.</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center flex-column">

                <div class="btn-group div-crypto">
                    <button class="btn btn-secondary btn-sm dropdown-toggle crypto-btn" data-bs-display="static" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                      BTC
                    </button>
                    <ul class="dropdown-menu ul-crypto">
                        <li class="item-li li-first">
                            <img class="input-prefix " src="assets/bitcoin.svg" width="70px" height="70px">
                            <a class="dropdown-item item-crypto" href="#">BTC</a>
                            
                        </li>
                        <li class="item-li">
                            <img class="input-prefix " src="assets/ETH.svg" width="70px" height="70px">
                            <a class="dropdown-item item-crypto" href="#">ETH</a>                           
                        </li>
                        <li class="item-li li-last">
                            <img class="input-prefix " src="assets/LTC.svg" width="70px" height="70px">
                            <a class="dropdown-item item-crypto" href="#">LTC</a>
                        </li>
                    </ul>
                  </div>

                  <div class="crypto-input text-edit" >
                    <input id="myInput" class="set-crypto" type="text"  name="fname" placeholder="3PkPN3YDSzu8Yp6sd3bapWVUXgPeX1bthB">
                    <button onclick="myFunction()">Copy text</button>
                    <div class="div-crypto-img">
                        <img src="../assets/QR.svg" alt="">
                    </div> 
                    <span class="crypto-text">Only send BTC to this address, 1 confirmation(s) required. We do not accept BEP20 from Binance.y</span>        
                </div>
                <!--
                    <div class="btn-group btn-div" >
                        <button class="btn btn-secondary btn-sm dropdown-toggle crypto-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                             BTC
                        </button>
                        <ul class="dropdown-menu cola mx-auto">
                            <li class="item-crypto">BTC</li>
                            <li class="item-crypto">ETH</li>
                            <li class="item-crypto">LTC</li>
                            <li class="item-crypto">DOGE</li>
                            <li class="item-crypto">BCH</li>
                        </ul>
                    </div>
                    <div class="total-referral text-edit" >
                        <input id="set-referral" class="set-code" type="text"  name="fname" placeholder="DFH#HH">
                    </div>
                -->
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('js/partials/crypto.js') }}"></script>
@endpush
