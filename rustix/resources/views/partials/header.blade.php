<header class="d-flex ps-5 pe-5 pt-4 pb-4 header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black w-100">
        <div class="container-fluid ">
            <h1 class="h2"><span class="green">RUSTIX</span><span class="white">.COM</span></h1>
            <a class="nav-link me-auto" href="#">
                <i class="fas fa-coins green d-inline"></i>
                <p class="ms-1 d-inline">FREE COINS</p>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
           <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @if (Auth::check())
                    <li class="nav-item me-2"><a class="nav-link active font" aria-current="page" href="#">WITHDRAW</a></li>
                    <balance user="{{ Auth::user()->steamid }}" class="me-4 ms-2 text-white nav-item"></balance>
                    <li class="nav-item me-2 color"><a class="nav-link me-4 ms-4 text-white" href="{{ URL::route('getUserInventory') }}">DEPOSIT</a></li>

                    <li class="nav-item dropdown dropdown-menu-end me-2 ms-2">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-white mt-4 rounded-0" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item py-3 " href="#">Profile</a></li>
                            <li><a class="dropdown-item py-3" href="#">Referral</a></li>
                            <li><a class="dropdown-item py-3" href="{{ URL::route('logOut') }}">Log Out</a></li>
                            <li class="color"><a class="dropdown-item py-3 text-white hov-green" href="#">Admin Panel</a></li>
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

