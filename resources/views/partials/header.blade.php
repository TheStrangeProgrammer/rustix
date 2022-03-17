<header class="header theme-bc-2">
    <nav class="navbar navbar-expand-lg navbar-dark w-100">
        <div class="container-fluid justify-content-evenly">

            <a class="theme-tc-1 mb-0 ms-2 me-2" href="{{ URL::route('home') }}"><span
                    class="site-title">RUSTIX</span>
            </a>
            <nav class="navbar navbar-expand-lg navbar-dark" style="margin-left: 10px">
                <div class="container">
                   
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        

                        
                        <ul class="navbar-nav dropdown-menu-right">
                            
                            <li class="nav-item dropdown dropdown-game d-flex flex-row">
                                <img class=" img-games" src='../assets/roulette/house.svg' height="15px" width="15px">
                                <a class="nav-link link-games dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding-left: .25rem">
                                Games
                                </a>
                                
                                    <ul class="dropdown-menu dropdown-game-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <div class="games-div">
                                            <a class="card-game" href="{{ URL::route('roulette') }}" style="width: 12%">
                                                <div class="top-card">
                                                    <h5 class="game-text">ROULETTE</h5>
                                                </div>
                                                <div class="card-img-top-wrapper" style="background-image: url('../assets/Capture.svg'">
                                                    
                                                </div>
                                            </a>
                                            <a class="card-game" href="{{ URL::route('x-roulette') }}" style="width: 12%">
                                                <div class="top-card">
                                                    <h5 class="game-text">X-ROULETTE</h5>
                                                </div>
                                                <div class=" card-img-top-wrapper" style="background-image: url('../assets/Capture2.svg'">
                                                    
                                                </div>
                                            </a>
                                        </div>
                                    </ul>
                                
                            </li>
                        </ul>
                    
                    </div>
                </div>
            </nav>


            @if (Auth::check())
                <div class="balance-div theme-bc-1 ms-auto me-3">
                    <balance class="text-center my-auto" user="{{ Auth::user()->id }}">
                    </balance>
                </div>

                <button class="navbar-toggler hamburger-menu " type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <input id="menu__toggle" type="checkbox" />
                    <label class="menu__btn" for="menu__toggle">
                        <div class="navbar-toggler-icon"></div>

                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button id="deposit-button" class="theme-bc-3 me-auto deposit-button" data-bs-toggle="modal"
                        data-bs-target="#TRANSFER">DEPOSIT</button>

                        <div class="d-flex flex-column">
                            <button onclick="myFunction_1()" id="btn-1">Try it</button>
                            <div id="myDIV" class="mt-5" style="display: none;">This is my DIV element.</div>
                        <br><br>
                        </div>
                        
                       



                    <ul class="navbar-nav mb-2 mb-lg-0 navbar-dark ">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle me-auto d-flex align-items-center justify-content-center py-0 black"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="overflow-visible mx-2" src="{{ Auth::user()->avatar }}">
                                <span class="theme-tc-1" id="user-name">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end header-dropdown py-0" aria-labelledby="navbarDropdown">
                                <li><button id="profile-button" class="dropdown-item header-dropdown-item text-center last-div"
                                        data-bs-toggle="modal" data-bs-target="#PROFILE">Profile</button></li>

                                <li><button id="withdraw-button" class="dropdown-item header-dropdown-item text-center "
                                        data-bs-toggle="modal" data-bs-target="#WITHDRAW">Withdraw</button></li>
                                <li><button id="referrals-button" class="dropdown-item header-dropdown-item text-center "
                                        data-bs-toggle="modal" data-bs-target="#REFERRALS">Referrals</button></li>
                                <li><a class="dropdown-item header-dropdown-item text-center " href="{{ URL::route('logOut') }}">Log
                                        Out</a></li>
                                @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                    <li><button id="admin-button" class="dropdown-item header-dropdown-item text-center edit-admin"
                                            style="color: #E6E6E6" data-bs-toggle="modal" data-bs-target="#ADMIN">Admin
                                            Panel</button></li>
                                @endif
                                <li class="free-coins-mobile"><button id="free-coins" class="free-coins">Claim your
                                        free coins</button></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            @else
                <a class="theme-tc-1 nav-link core" href="{{ URL::route('login') }}">Log In</a>
            @endif
        </div>
    </nav>
</header>
@push('js')
    <script src="{{ asset('js/partials/header.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endpush

<!--

-->
