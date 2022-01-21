<header class="d-flex ps-5 pe-5 pt-4 pb-4 header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black w-100">
        <div class="container-fluid ">
            <h1 class="h2 mb-0"><span class="green">RUSTIX</span><span class="white">.COM</span></h1>
            <a id="coins" class="d-flex nav-link d-none" href="#">
                <i class="bi bi-coin green"></i>
                <span class="fw-100 align-self-center" style="color: white">FREE COINS</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto ">
                    @if (Auth::check())
                    <li class="nav-item py-2 "><a class="nav-link text-center active font black" aria-current="page" href="{{ URL::route('getDeposit') }}">WITHDRAW</a></li>
                    <balance class="text-center nav-item mx-3 py-3 black fw-bold" style="color: rgb(255, 255, 255)" user="{{ Auth::user()->steamid }}" ></balance>
                    <li class="nav-item color mx-3 my-2 "><a class="nav-link text-center mx-4 black fw-bold" style="color: white" href="{{ URL::route('getUserInventory') }}">DEPOSIT</a></li>

                    <li class="nav-item dropdown py-2">
                        <a class="nav-link dropdown-toggle me-auto d-flex align-items-center justify-content-center py-0 black fw-bold" style="color: white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class=" overflow-visible" src="{{ Auth::user()->avatar }}">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-white dropdown-menu-end py-0 rounded-0" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-center py-3"  href="{{ URL::route('getProfile') }}">Profile</a></li>
                            <li><a class="dropdown-item text-center py-3" href="#">Referral</a></li>
                            <li><a class="dropdown-item text-center py-3" href="{{ URL::route('logOut') }}">Log Out</a></li>
                            <li class="color"><a class="dropdown-item text-center py-3 text-white hov-green" href="#">Admin Panel</a></li>
                        </ul>
                    </li>
                    @else



                    <li class="nav-item "><a class="nav-link" href="{{ URL::route('login') }}">Log In</a></li>
                    @endif
                </ul>
            </div>
        </div>
      </nav>
</header>

