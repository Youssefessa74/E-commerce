@extends('vendor.layout.master')

@section('title')
    {{ Auth::user()->name }} |Create Withdraw Request
@endsection

@section('content')
    <!--=============================
                                DASHBOARD START
                 ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layout.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Create Withdraw Request</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="row d-flex">
                                <div class="wsus__dash_pro_area col-md-6">
                                    <form action="{{ route('vendor.request-with-draw.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group wsus__input">
                                            <label>Method</label>
                                            <select name="method" id="method" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($methods as $method)
                                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group wsus__input">
                                            <label>Withdraw Amount</label>
                                            <input type="text" class="form-control" name="amount">
                                        </div>
                                        <div class="form-group wsus__input">
                                            <label>Account Information</label>
                                            <textarea name="account_info" class="form-control"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </form>
                                </div>

                                <!-- Account Info Area -->
                                <div class="wsus__dash_pro_area col-md-6 account_info_area " style="padding-left: 15px;">
                                    <!-- AJAX content will be inserted here -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--=============================
                                DASHBOARD END
                            ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#method').on('change', function() {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('vendor.request-with-draw.show', ':id') }}'.replace(":id", id),
                    beforeSend: function() {},
                    success: function(response) {
                        // Extract data from response
                        let name = response.name;
                        let minAmount = response.minimum_amount;
                        let maxAmount = response.maximum_amount;
                        let withdrawCharge = response.withdraw_charge;
                        let description = response.description; // Assuming it's safe HTML

                        // Construct the HTML to display
                        let htmlContent = `
                <p><strong>Name:</strong> ${name}</p>
                <p><strong>Minimum Amount:</strong> ${minAmount}</p>
                <p><strong>Maximum Amount:</strong> ${maxAmount}</p>
                <p><strong>Withdraw Charge:</strong> ${withdrawCharge}</p>
                ${description} <!-- Use description directly if it contains HTML -->
            `;

                        // Insert into the container
                        $('.account_info_area').html(htmlContent);
                    },
                    error: function(xhr, status, error) {
                        console.log('An error occurred:', error);
                    },
                    complete: function() {},
                });
            });

        });
    </script>
@endpush
