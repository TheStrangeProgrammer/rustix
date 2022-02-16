<header class="d-flex ps-5 pe-5 header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black w-100">
        <div class="container-fluid ">
            <a class="h2 mb-0" href="{{ URL::route('home') }}"><span class="green">RUSTIX</span>
            </a>
            
            
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="d-flex collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="d-flex justify-content-center navbar-nav mx-auto ">
                        @if (Auth::check())
                        <balance class="text-center my-auto " style="align-items: center"
                    user="{{ Auth::user()->id }}"></balance>
                        <li class="d-flex nav-item"><a
                                style="color: white" class="color" href="{{ URL::route('getUserInventory') }}">DEPOSIT</a></li>

                    </ul>
                    <li class="nav-item dropdown py-2 self-align-end">
                        <a class="nav-link dropdown-toggle me-auto d-flex align-items-center justify-content-center py-0 black"
                            style="color: white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="overflow-visible mx-2" src="{{ Auth::user()->avatar }}">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-white dropdown-menu-end py-0 rounded-0"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-center py-3"
                                    href="{{ URL::route('getProfile') }}">Profile</a></li>
                            <li><a class="dropdown-item text-center py-3" aria-current="page"
                                    href="{{ URL::route('getDeposit') }}">Withdraw</a></li>
                            <li><a class="dropdown-item text-center py-3" href="#">Referral</a></li>
                            <li><a class="dropdown-item text-center py-3" href="{{ URL::route('logOut') }}">Log
                                    Out</a></li>
                            <li class="color"><a
                                    class="dropdown-item text-center py-3 text-white hov-green"
                                    href="http://localhost/admin">Admin Panel</a></li>
                        </ul>
                    </li>
                </div>
            @else
                <a class="nav-item" href="{{ URL::route('login') }}">Log In</a>
            @endif
        </div>
    </nav>
</header>
