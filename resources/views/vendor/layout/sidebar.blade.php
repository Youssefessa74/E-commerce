<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="{{ asset('frontend/images') }}/logo.png"
            alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="{{ setActive(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a class="{{ setActive(['home']) }}" href="{{ route('home') }}"><i class="fas fa-home"></i>Go To Shop</a></li>
        <li><a class="{{ setActive(['vendor.messenger.index']) }}" href="{{ route('vendor.messenger.index') }}"><i class="fab fa-rocketchat"></i>Messenger</a></li>
        <li><a class="{{ setActive(['vendor.orders.*']) }}" href="{{ route('vendor.orders.index') }}"><i class="fas fa-list-ul"></i> Orders</a></li>
        <li><a class="{{ setActive(['vendor.reviews']) }}" href="{{ route('vendor.reviews') }}"><i class="far fa-star"></i> Reviews</a></li>
        <li><a class="{{ setActive(['vendor.vendor-shop.*']) }}" href="{{ route('vendor.vendor-shop.index') }}"><i class="far fa-star"></i>Shop Profile</a></li>
        <li><a class="{{ setActive(['vendor.products.*']) }}" href="{{ route('vendor.products.index') }}"><i class="far fa-star"></i>Products</a></li>
        <li><a class="{{ setActive(['vendor.request-with-draw.*']) }}" href="{{ route('vendor.request-with-draw.index') }}"><i class="far fa-star"></i>Withdraw Request</a></li>
        <li><a class="{{ setActive(['vendor_profile']) }}" href="{{ route('vendor_profile') }}"><i class="far fa-user"></i> My Profile</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="far fa-sign-out-alt"></i> Log out</a></li>
    </ul>
</div>
