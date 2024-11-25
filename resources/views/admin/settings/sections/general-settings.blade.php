<div class="tab-pane fade show active" id="list-general-settings" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-header">
            <h5>Site</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.general.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Row 1: Site Name and Layout -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site Name</label>
                            <input type="text" class="form-control" value="{{ @$generalSettings->site_name }}" name="site_name">
                        </div>
                        @if ($errors->has('site_name'))
                            <div>
                                <p style="color: red;">{{ $errors->first('site_name') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Layout</label>
                            <select name="layout" class="form-control" id="">
                                <option @selected($generalSettings->layout == 'LTR') value="LTR">LTR</option>
                                <option  @selected($generalSettings->layout == 'RTL') value="RTL">RTL</option>
                            </select>
                        </div>
                        @if ($errors->has('layout'))
                            <div>
                                <p style="color: red;">{{ $errors->first('layout') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Row 2: Contact E-Mail and Time Zone -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Contact E-Mail</label>
                            <input type="text" class="form-control" value="{{ @$generalSettings->contact_mail }}" name="contact_mail">
                        </div>
                        @if ($errors->has('contact_mail'))
                            <div>
                                <p style="color: red;">{{ $errors->first('contact_mail') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Contact Phone</label>
                            <input type="text" class="form-control" value="{{ @$generalSettings->contact_phone }}" name="contact_phone">
                        </div>
                        @if ($errors->has('contact_phone'))
                            <div>
                                <p style="color: red;">{{ $errors->first('contact_phone') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Contact Address</label>
                            <input type="text" class="form-control" value="{{ @$generalSettings->contact_address }}" name="contact_address">
                        </div>
                        @if ($errors->has('contact_address'))
                            <div>
                                <p style="color: red;">{{ $errors->first('contact_address') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Time Zone</label>
                    <select name="time_zone" class="form-control select2" id="">
                        @foreach (config('settings.time_zone') as $key =>$item)
                            <option  @selected($generalSettings->time_zone == $key) value="{{ $key }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('time_zone'))
                    <div>
                        <p style="color: red;">{{ $errors->first('time_zone') }}</p>
                    </div>
                @endif

                <!-- Row 3: Default Currency Name and Currency Icon -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Default Currency Name</label>
                            <select name="currency_name" class="form-control select2" id="">
                                @foreach (config('settings.currency_list') as $item)
                                    <option  @selected($generalSettings->currency_name == $item) value="{{ $item }}">{{ $item }}</option>
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
                            <label for="">Currency Icon</label>
                            <input type="text" class="form-control" value="{{ @$generalSettings->currency_icon }}" name="currency_icon">
                        </div>
                        @if ($errors->has('currency_icon'))
                            <div>
                                <p style="color: red;">{{ $errors->first('currency_icon') }}</p>
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
