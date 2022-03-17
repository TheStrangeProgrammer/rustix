<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/pachinko.css') }}">
<div id="PACHINKO" class="modal fade" tabindex="-1" aria-labelledby="DEPOSIT-title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-pachinko">
        <div class="modal-content modal-content-coinflip h-100">
            <div class="modal-header modal-header-pachinko">
                <h5 id="DEPOSIT-title" class="modal-title ">PACHINKO</h5>
                <button type="button" class="btn-close color-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-coinflip d-flex flex-column">
                <div class="border-grad-pachinko"></div>
                    <div class="d-flex justify-content-center align-self-center flex-column m-auto">
                        <div class="d-flex flex-row justify-content-center" style="margin-top: 10px">
                                <div class="first-circle-pachinko">
                                    <span>X</span><input type="number" value="3">
                                </div>
                                <div class="first-circle-pachinko">
                                    <span>X</span><input type="number" value="3">
                                </div>
                                <div class="first-circle-pachinko">
                                    <span>X</span><input type="number" value="3">
                                </div>
                                <div class="first-circle-pachinko">
                                    <span>X</span><input type="number" value="3">
                                </div>
                                <div class="first-circle-pachinko">
                                    <span>X</span><input type="number" value="3">
                                </div>
                                <div class="first-circle-pachinko">
                                    <span>X</span><input type="number" value="3">
                                </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center" style="margin-top: 10px">
                            <div class="first-circle-pachinko">
                                <span>X</span><input type="number" value="3">
                            </div>
                            <div class="first-circle-pachinko">
                                <span>X</span><input type="number" value="3">
                            </div>
                            <div class="first-circle-pachinko">
                                <span>X</span><input type="number" value="3">
                            </div>
                            <div class="first-circle-pachinko">
                                <span>X</span><input type="number" value="3">
                            </div>
                            <div class="first-circle-pachinko">
                                <span>X</span><input type="number" value="3">
                            </div>
                            <div class="first-circle-pachinko">
                                <span>X</span><input type="number" value="3">
                            </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center" style="margin-top: 10px">
                        <div class="first-circle-pachinko">
                            <span>X</span><input type="number" value="3">
                        </div>
                        <div class="first-circle-pachinko">
                            <span>X</span><input type="number" value="3">
                        </div>
                        <div class="first-circle-pachinko">
                            <span>X</span><input type="number" value="3">
                        </div>
                        <div class="first-circle-pachinko">
                            <span>X</span><input type="number" value="3">
                        </div>
                        <div class="first-circle-pachinko">
                            <span>X</span><input type="number" value="3">
                        </div>
                        <div class="first-circle-pachinko">
                            <span>X</span><input type="number" value="3">
                        </div>
                </div>
                <div class="d-flex flex-row justify-content-center" style="margin-top: 10px">
                    <div class="first-circle-pachinko">
                        <span>X</span><input type="number" value="3">
                    </div>
                    <div class="first-circle-pachinko">
                        <span>X</span><input type="number" value="3">
                    </div>
                    <div class="first-circle-pachinko">
                        <span>X</span><input type="number" value="3">
                    </div>
                    <div class="first-circle-pachinko">
                        <span>X</span><input type="number" value="3">
                    </div>
                    <div class="first-circle-pachinko">
                        <span>X</span><input type="number" value="3">
                    </div>
                    <div class="first-circle-pachinko">
                        <span>X</span><input type="number" value="3">
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('js/partials/pachinko.js') }}"></script>
@endpush
