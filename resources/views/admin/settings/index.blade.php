
@extends('admin.layout.master')
@section('title')
    Settings
@endsection
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Settings</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                              <h4>All Settings</h4>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-4">
                                  <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-general-settings" role="tab">General Settings</a>
                                    <a class="list-group-item list-group-item-action" id="list-email-config-list" data-toggle="list" href="#list-email-config" role="tab">E-mail Configrations</a>
                                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Logo Settings</a>
                                    <a class="list-group-item list-group-item-action" id="list-pusher-settings-list" data-toggle="list" href="#list-pusher-settings" role="tab">Pusher Settings</a>
                                  </div>
                                </div>
                                <div class="col-8">
                                  <div class="tab-content" id="nav-tabContent">
                                  @include('admin.settings.sections.general-settings')
                                  @include('admin.settings.sections.mail-conig')
                                  @include('admin.settings.sections.logo-setting')
                                  @include('admin.settings.sections.pusher')

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
