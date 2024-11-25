<div class="tab-pane fade" id="list-email-config" role="tabpanel" aria-labelledby="list-email-config-list">
    <div class="card border">
        <div class="card-header">
            <h5>Site</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mail.configuration') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">E-mail</label>
                    <input type="text" class="form-control" value="{{ $mailSettings->email }}" name="email">
                </div>
                @if ($errors->has('email'))
                    <div>
                        <p style="color: red;">{{ $errors->first('email') }}</p>
                    </div>
                @endif

                <div class="form-group">
                    <label for="">Mail Host</label>
                    <input type="text" class="form-control" value="{{ $mailSettings->host }}" name="host">
                </div>
                @if ($errors->has('host'))
                    <div>
                        <p style="color: red;">{{ $errors->first('host') }}</p>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Stmp Username</label>
                            <input type="text" class="form-control" value="{{ $mailSettings->username }}" name="username">
                        </div>
                        @if ($errors->has('username'))
                            <div>
                                <p style="color: red;">{{ $errors->first('username') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Smtp Password</label>
                            <input type="text" class="form-control" value="{{ $mailSettings->password }}" name="password">
                        </div>
                        @if ($errors->has('password'))
                            <div>
                                <p style="color: red;">{{ $errors->first('password') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Mail Port</label>
                            <input type="text" class="form-control" value="{{ $mailSettings->port }}" name="port">
                        </div>
                        @if ($errors->has('port'))
                            <div>
                                <p style="color: red;">{{ $errors->first('port') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Mail Host</label>
                            <select name="encryption" id="" class="form-control">
                                <option @selected($mailSettings->encryption == 'tls') value="tls">TLS</option>
                                <option @selected($mailSettings->encryption == 'ssl') value="ssl">SSL</option>
                            </select>
                        </div>
                        @if ($errors->has('encryption'))
                            <div>
                                <p style="color: red;">{{ $errors->first('encryption') }}</p>
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
