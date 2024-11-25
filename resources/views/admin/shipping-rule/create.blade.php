@extends('admin.layout.master')
@section('title')
    Create Shipping Rule
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
                                <h4>Create Shipping Rule</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.shipping-rule.store') }}" method="POST">
                                    @csrf


                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name">
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
                                            <option value="flat_cost">Flat Cost</option>
                                            <option value="min_cost">Minimum Order Amount</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('type'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('type') }}</p>
                                        </div>
                                    @endif


                                    <div class="form-group d-none" id="min_cost">
                                        <label for="">Min Cost</label>
                                        <input type="number" class="form-control" name="min_cost">
                                    </div>
                                    @if ($errors->has('min_cost'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('min_cost') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Cost</label>
                                        <input type="number" class="form-control" name="cost">
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
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
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
        $('#cost_type').on('change',function(){
            let cost_type = $(this);
            if(cost_type.val() == 'min_cost'){
                $('#min_cost').removeClass('d-none');
            } else{
                $('#min_cost').addClass('d-none');
            }
        });
    });
</script>
@endpush
