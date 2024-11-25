<div class="tab-pane fade" id="list-pusher-settings" role="tabpanel" aria-labelledby="list-pusher-settings-list">
    <div class="card border">
        <div class="card-header">
            <h5>Pusher Settings</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.update.pusher.settings') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">App ID</label>
                            <input type="text" class="form-control" value="{{ @$pusher->app_id }}"
                                name="app_id">
                        </div>
                        @if ($errors->has('app_id'))
                            <div>
                                <p style="color: red;">{{ $errors->first('app_id') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Key</label>
                            <input type="text" class="form-control"  value="{{ @$pusher->key }}"
                                name="key">
                        </div>
                        @if ($errors->has('key'))
                            <div>
                                <p style="color: red;">{{ $errors->first('key') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Secret</label>
                            <input type="text" class="form-control"  value="{{ @$pusher->secret }}"
                                name="secret">
                        </div>
                        @if ($errors->has('secret'))
                            <div>
                                <p style="color: red;">{{ $errors->first('secret') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cluster</label>
                            <input type="text" class="form-control"  value="{{ @$pusher->cluster }}"
                                name="cluster">
                        </div>
                        @if ($errors->has('cluster'))
                            <div>
                                <p style="color: red;">{{ $errors->first('cluster') }}</p>
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
