@extends('admin.layout.master')
@section('title')
    Edit Shipping Rule
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Shipping Rule</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Shipping Rule</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.shipping-rule.update',$shipping->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" value="{{ $shipping->name }}" name="name">
                                    </div>
                                    @if ($errors->has('name'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('name') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">type</label>
                                        <select name="type" id="cost_type" class="form-control">
                                            <option @selected($shipping->type == 'flat_cost') value="flat_cost">Flat Cost</option>
                                            <option @selected($shipping->type == 'min_cost') value="min_cost">Minimum Order Amount</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('type'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('type') }}</p>
                                        </div>
                                    @endif


                                    <div class="form-group " id="min_cost">
                                        <label for="">Min Cost</label>
                                        <input type="number" class="form-control" id="min_cost_input" value="{{ $shipping->min_cost }}" name="min_cost">
                                    </div>
                                    @if ($errors->has('min_cost'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('min_cost') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Cost</label>
                                        <input type="number" class="form-control" value="{{ $shipping->cost }}" name="cost">
                                    </div>
                                    @if ($errors->has('cost'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('cost') }}</p>
                                        </div>
                                    @endif



                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option @selected($shipping->type == 1) value="1">Active</option>
                                            <option @selected($shipping->type == 0) value="0">In Active</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('status') }}</p>
                                        </div>
                                    @endif

                                    <button type="submit" class="btn btn-primary">submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        // Trigger the change event when the page loads to handle preselected option
        handleCostTypeChange();

        $('#cost_type').on('change', function() {
            handleCostTypeChange();
        });

        function handleCostTypeChange() {
            let cost_type = $('#cost_type').val();

            if (cost_type === 'flat_cost') {
                $('#min_cost').addClass('d-none');   // Hide the Min Cost field
                $('#min_cost_input').val(0);         // Set Min Cost value to 0
            } else {
                $('#min_cost').removeClass('d-none'); // Show the Min Cost field
                $('#min_cost_input').val('{{ $shipping->min_cost }}'); // Restore the previous Min Cost value
            }
        }
    });
</script>
@endpush
