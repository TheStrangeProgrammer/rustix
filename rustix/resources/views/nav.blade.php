
<nav class="fullw flex between">

    <div class="right fullh flex center mr50 bold">
        <button class="flex pad10 thin">WITHDRAW</button>
        <div class="flex pad10">BALANCE:<span class="green ml5">33.21USD</span></div>
        <button id="depositBTN"class="flex pad10">DEPOSIT</button>
        <span>
            <button apartine="userDropDown" class="toggler flex pad10">STEAM USERNAME <i class="fas fa-caret-down ml5"></i></button>
            <div id="userDropDown" class="dropdown flexcol regular">
                <button class="fullw btnChoice"><p class="ml10">Profile</p></button>
                <button class="fullw btnChoice"><p class="ml10">Affiliate</p></button>
                <button class="fullw btnChoice"><p class="ml10">Log Out</p></button>
                <button class="fullw bggreen btnChoice"><p class="ml10 bold white">Admin Panel</p></button>
            </div>
        </span>
    </div>
    <button apartine="mobileNav" id="burgerBTN" class="toggler fas fa-bars"></button>

    <div id="mobileNav" class="flexcol center dropdown">
        <div class="flex">BALANCE:<span class="green ml5">33.21USD</span></div>
        <button class="thin fullw btnChoice">WITHDRAW</button>
        <button id="depositBTN" class="fullw white bold btnChoice">DEPOSIT</button>
        <span class="fullw">
            <button apartine="mobileNav #userDropDown" class="toggler fullw">STEAM USERNAME <i class="fas fa-caret-down ml5"></i></button>
            <div id="userDropDown" class="dropdown flexcol regular">
                <button class="fullw btnChoice"><p class="ml10">Profile</p></button>
                <button class="fullw btnChoice"><p class="ml10">Affiliate</p></button>
                <button class="fullw btnChoice"><p class="ml10">Log Out</p></button>
                <button class="fullw bggreen btnChoice"><p class="ml10 bold white">Admin Panel</p></button>
            </div>
        </span>
</nav>
