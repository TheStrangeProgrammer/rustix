<header class="d-flex">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black w-100">
        <div class="container-fluid">
            <h3><span class="green">RUSTIX</span>.COM</h3>
            <a class="nav-link me-auto" href="#">
                <i class="fas fa-coins green d-inline"></i>
                <p class="ms-1 d-inline">FREE COINS</p>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Withdraw</a>
                </li>
                @if (Auth::check())
                <balance user="{{ Auth::user()->steamid }}"></balance>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ URL::route('getUserInventory') }}">Deposit</a>
                </li>
                <li class="nav-item dropdown">

                    @if (Auth::check())
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Referral</a></li>
                        <li><a class="dropdown-item" href="{{ URL::route('logOut') }}">Log Out</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Admin Panel</a></li>
                        </ul>
                    @else
                        <a class="nav-link" href="{{ URL::route('steam') }}">
                        Log In
                        </a>

                    @endif

                </li>

                </ul>
            </div>
        </div>
      </nav>
</header>
<!--
<header class="d-flex navbar">

    <h3><span class="green">RUSTIX</span>.COM</h3>
    <a href="">
        <i class="fas fa-coins green"></i>
        <p class="ms-1">FREE COINS</p>
    </a>


    <nav class="d-flex navbar navbar-expand-lg">
        <div class="d-flex">
            <ul>
            <a href="#">WITHDRAW</a>
            <span>BALANCE:<span>33.21USD</span></span>
            <a href="#" >DEPOSIT</a>
            <button>STEAM USERNAME</a>
            <div class="d-none">
                <a href="#" >Profile</a>
                <a href="#">Affiliate</a>
                <a href="#">Log Out</a>
                <a href="#">Admin Panel</a>
            </div>

        </div>
        <a href="#"></a>

        <div>
            <div>BALANCE:<span>33.21USD</span></div>
            <a href="#">WITHDRAW</a>
            <a href="#">DEPOSIT</a>
            <span>
                <a href="#">STEAM USERNAME <i></i></a>
                <div>
                    <a href="#">Profile</a>
                    <a href="#">Affiliate</a>
                    <a href="#">Log Out</a>
                    <a href="#">Admin Panel</a>
                </div>
            </span>

    </nav>

</header>
-->
