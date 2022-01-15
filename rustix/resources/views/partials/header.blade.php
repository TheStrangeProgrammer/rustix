<header class="d-flex ps-5 pe-5 pt-4 pb-4 header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black w-100">
        <div class="container-fluid ">
            <h1 class="h2 mb-0"><span class="green">RUSTIX</span><span class="white">.COM</span></h1>
            <a id="coins" class="d-flex nav-link" href="#">
                <i class="bi bi-coin green"></i>
                <span class="fw-100 align-self-center" style="color: white">FREE COINS</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @if (Auth::check())
                    <li class="nav-item my-2"><a class="nav-link text-center active font" aria-current="page" href="#">WITHDRAW</a></li>
                    <balance class="text-center text-white nav-item mx-3 my-2" user="{{ Auth::user()->steamid }}" ></balance>
                    <li class="nav-item color mx-3 my-2"><a class="nav-link text-center text-white mx-4" href="{{ URL::route('getUserInventory') }}">DEPOSIT</a></li>
                    <li class="nav-item dropdown dropdown-menu-end px-auto d-flex align-items-center mx-4 my-2">
                        <img class="ms-auto d-inline-block overflow-visible" src="{{ Auth::user()->avatar }}">
                            <a class="nav-link dropdown-toggle text-white me-auto" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-white py-0 rounded-0" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-center py-3" href="{{ URL::route('getProfile') }}">Profile</a></li>
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

