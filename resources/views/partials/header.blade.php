@if (Auth::check())
@include('partials.header.deposit')
@include('partials.header.withdraw')
@include('partials.header.profile')
@endif
<header class="d-flex ps-5 pe-5 header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black w-100">
        <div class="container-fluid">
            <a class="h2 mb-0" href="{{ URL::route('home') }}"><span class="green">RUSTIX</span>
            </a>

            @if (Auth::check())
                <balance class="text-center my-auto" style="align-items: center" user="{{ Auth::user()->id }}">
                </balance>
                <button id="deposit-button" class="text-center p-1 mt-3" data-bs-toggle="modal"
                    data-bs-target="#DEPOSIT">DEPOSIT</button>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle me-auto d-flex align-items-center justify-content-center py-0 black"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="overflow-visible mx-2" src="{{ Auth::user()->avatar }}">
                            <span id="user-name">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-white dropdown-menu-end py-0 rounded-0"
                            aria-labelledby="navbarDropdown">
                            <li><button id="profile-button" class="dropdown-item text-center py-3" data-bs-toggle="modal"
                                data-bs-target="#PROFILE">PROFILE</button></li>

                            <li><button id="withdraw-button" class="dropdown-item text-center py-3" data-bs-toggle="modal"
                                    data-bs-target="#WITHDRAW">WITHDRAW</button></li>
                            <li><a class="dropdown-item text-center py-3" href="#">Referral</a></li>
                            <li><a class="dropdown-item text-center py-3" href="{{ URL::route('logOut') }}">Log
                                    Out</a></li>
                            <li class="color"><a class="dropdown-item text-center py-3 text-white hov-green"
                                    href="http://localhost/admin">Admin Panel</a></li>
                        </ul>
                    </li>
                </ul>
            @else
                <a class="nav-item" href="{{ URL::route('login') }}">Log In</a>
            @endif
        </div>
    </nav>
</header>
