@extends('frontend.dashboard.layout.master')
@section('title')
    {{ Auth::user()->name }} | Address
@endsection
@section('content')
<style>
    .wsus__address_btn a {
    display: inline-block; /* Allow the links to have block-like behavior */
    width: 100px; /* Set a fixed width */
    text-align: center; /* Center the text */
    padding: 10px; /* Add some padding for better appearance */
    text-decoration: none; /* Remove underline */
    color: inherit; /* Inherit color from parent */
    border: 1px solid #ccc; /* Add a border if desired */
    border-radius: 4px; /* Optional: Add rounded corners */
}

.wsus__address_btn a:hover {
    background-color: #f0f0f0; /* Change background on hover */
}
</style>
    <!--=============================
                    DASHBOARD START
                  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layout.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <h3><i class="fal fa-gift-card"></i> address</h3>
                        <div class="wsus__dashboard_add">
                            <div class="row">
                                @foreach ($userAddresses as $item)
                                    <div class="col-xl-6">
                                        <div class="wsus__dash_add_single">
                                            <h4>Billing Address <span>office</span></h4>
                                            <ul>
                                                <li><span>name :</span> {{ $item->name }}</li>
                                                <li><span>Phone :</span> {{ $item->phone }}</li>
                                                <li><span>email :</span> {{ $item->email }}</li>
                                                <li><span>country :</span> {{ $item->country }}</li>
                                                <li><span>city :</span> {{ $item->city }}</li>
                                                <li><span>zip code :</span> {{ $item->zip }}</li>
                                                <li><span>address :</span> {{ $item->address }}</li>
                                            </ul>
                                            <div class="wsus__address_btn">
                                                <a href="{{ route('address.edit', $item->id) }}" class="edit"><i class="fal fa-edit"></i> edit</a>
                                                <form action="{{ route('address.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="del" onclick="return confirmDelete(this);">
                                                        <i class="fal fa-trash-alt"></i> delete
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-12">
                                    <a href="{{ route('address.create') }}" class="add_address_btn common_btn"><i
                                            class="far fa-plus"></i>
                                        add new address</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                    DASHBOARD START
           ==============================-->
@endsection
<script>
    function confirmDelete(link) {
        if (confirm('Are you sure you want to delete this item?')) {
            link.closest('form').submit();
        }
        return false; // Prevent default action
    }
</script>
