<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="{{ asset('frontend/images') }}/logo.png"
            alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="{{ setActive(['dashboard']) }}" href="{{ route('dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a class="{{ setActive(['home']) }}" href="{{ route('home') }}"><i class="fas fa-home"></i>Go To Shop</a></li>
        <li><a class="{{ setActive(['messenger.index']) }}" href="{{ route('messenger.index') }}"><i class="fab fa-rocketchat"></i>Messenger</a></li>
        <li><a class="{{ setActive(['user.orders.*']) }}" href="{{ route('user.orders.index') }}"><i class="fas fa-list-ul"></i> Orders</a></li>
        <li><a class="{{ setActive(['user.reviews']) }}" href="{{ route('user.reviews') }}"><i class="far fa-star"></i> Reviews</a></li>
        <li><a class="{{ setActive(['vendor.request']) }}" href="{{ route('vendor.request') }}"><i class="far fa-heart"></i> Be a vendor</a></li>
        <li><a class="{{ setActive(['user_profile']) }}" href="{{ route('user_profile') }}"><i class="far fa-user"></i> My Profile</a></li>
        <li><a class="{{ setActive(['address.*']) }}" href="{{ route('address.index') }}"><i class="fas fa-address-card"></i> Addresses</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="far fa-sign-out-alt"></i> Log out</a></li>
    </ul>
</div>
