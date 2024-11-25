<div class="tab-pane fade show active" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-header">
            <h5>Stripe</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.stripe.setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Row 1: -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">stripe Cliend ID</label>
                            <input type="text" class="form-control" value="{{ @$stripe->client_id }}"
                                name="client_id">
                        </div>
                        @if ($errors->has('client_id'))
                            <div>
                                <p style="color: red;">{{ $errors->first('client_id') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">stripe Secret key</label>
                            <input type="text" class="form-control" value="{{ @$stripe->secret_key }}"
                                name="secret_key">
                        </div>
                        @if ($errors->has('secret_key'))
                            <div>
                                <p style="color: red;">{{ $errors->first('secret_key') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Currency Rate per ({{ $settings->currency_name }})</label>
                    <input type="text" class="form-control" value="{{ @$stripe->currency_rate }}"
                        name="currency_rate">
                </div>
                @if ($errors->has('currency_rate'))
                    <div>
                        <p style="color: red;">{{ $errors->first('currency_rate') }}</p>
                    </div>
                @endif

                <!-- Row 2: -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Account Mode</label>
                            <select name="mode" class="form-control" id="">
                                <option @selected(@$stripe->mode == 1) value="1">Live</option>
                                <option @selected(@$stripe->mode == 0) value="0">Sandnbox</option>
                            </select>
                        </div>
                        @if ($errors->has('mode'))
                            <div>
                                <p style="color: red;">{{ $errors->first('mode') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control" id="">
                                <option @selected(@$stripe->status == 1) value="1">Enabled</option>
                                <option @selected(@$stripe->status == 0) value="0">Disabled</option>
                            </select>
                        </div>
                        @if ($errors->has('status'))
                            <div>
                                <p style="color: red;">{{ $errors->first('status') }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Row 3: -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Currency Name</label>
                                <select name="currency_name" class="form-control select2" id="">
                                    @foreach (config('settings.currency_list') as $key => $item)
                                        <option @selected(@$stripe->currency_name == $item) value="{{ $item }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('currency_name'))
                                <div>
                                    <p style="color: red;">{{ $errors->first('currency_name') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Country</label>
                                <select name="country" class="form-control select2" id="">
                                    @foreach (config('settings.country_list') as $item)
                                        <option @selected(@$stripe->country == $item) value="{{ $item }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('country'))
                                <div>
                                    <p style="color: red;">{{ $errors->first('country') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

            </form>
        </div>
    </div>
</div>
