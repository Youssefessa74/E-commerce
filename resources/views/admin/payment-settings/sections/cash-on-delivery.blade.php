<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">
        <div class="card-header">
            <h5>Cash On Delivery</h5>
        </div>
        <div class="card-body">
    <form action="{{ route('admin.cash.on.delivery.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Status</label>
            <select name="status" class="form-control" id="">
                <option @selected(@$cod->status == 1) value="1">Active</option>
                <option @selected(@$cod->status == 0) value="0">In Active</option>
            </select>
        </div>
        @if ($errors->has('status'))
            <div>
                <p style="color: red;">{{ $errors->first('status') }}</p>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>
    </div>
</div>
