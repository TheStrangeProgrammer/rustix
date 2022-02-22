@if (Auth::check())
    @include('partials.header.deposit')
    @include('partials.header.withdraw')
    @include('partials.header.profile')
@endif
<header class="d-flex header theme-bc-2">
    <nav class="navbar navbar-expand-lg navbar-dark w-100">
        <div class="container-fluid justify-content-evenly h-100">

            <a class="theme-tc-1 mb-0 ms-2 me-auto" href="{{ URL::route('home') }}"><span class="site-title">RUSTIX</span>
            </a>

            @if (Auth::check())
                <balance class="theme-bc-1 text-center ms-auto me-3 cola" style="align-items: center" user="{{ Auth::user()->id }}">
                </balance>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button id="deposit-button" class="theme-bc-3 me-auto" data-bs-toggle="modal"
                        data-bs-target="#DEPOSIT">DEPOSIT</button>

                    <ul class="navbar-nav mb-2 mb-lg-0 navbar-dark ">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle me-auto d-flex align-items-center justify-content-center py-0 black"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="overflow-visible mx-2" src="{{ Auth::user()->avatar }}">
                                <span class="theme-tc-1" id="user-name">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-white dropdown-menu-end py-0 rounded-0"
                                aria-labelledby="navbarDropdown">
                                <li><button id="profile-button" class="dropdown-item text-center py-3"
                                        data-bs-toggle="modal" data-bs-target="#PROFILE">Profile</button></li>

                                <li><button id="withdraw-button" class="dropdown-item text-center py-3"
                                        data-bs-toggle="modal" data-bs-target="#WITHDRAW">Withdraw</button></li>
                                <li><a class="dropdown-item text-center py-3" href="#">Referral</a></li>
                                <li><a class="dropdown-item text-center py-3" href="{{ URL::route('logOut') }}">Log
                                        Out</a></li>
                                <li><a class="dropdown-item text-center py-3" href="http://localhost/admin">Admin
                                        Panel</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            @else
            <a class="theme-tc-1 nav-link me-2" href="{{ URL::route('login') }}">Log In</a>
            @endif
        </div>
    </nav>
</header>
