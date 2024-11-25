@extends('vendor.layout.master')
@section('title')
    {{ Auth::user()->name }} | Messenger
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
                        <h3><i class="far fa-star" aria-hidden="true"></i>Message</h3>
                        <div class="wsus__dashboard_review">
                            <div class="row">
                                <div class="col-xl-4 col-md-5">
                                    <div class="wsus__chatlist d-flex align-items-start">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <h2>Seller List</h2>
                                            <div class="wsus__chatlist_body">
                                                @foreach ($chatUsers as $user)
                                                    <button class="nav-link chat_user_profile"
                                                        data-id="{{ $user->sender->id }}" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-home" type="button" role="tab"
                                                        aria-controls="v-pills-home" aria-selected="true">
                                                        @php
                                                            $unSeenMessages = App\Models\Chat::where(
                                                                'sender_id',
                                                                $user->sender->id,
                                                            )
                                                                ->where('receiver_id', auth()->user()->id)
                                                                ->where('status', 0)
                                                                ->count();
                                                        @endphp
                                                        <div
                                                            class="wsus_chat_list_img {{ $unSeenMessages > 0 ? 'msg-notification' : '' }}">
                                                            <img id="chat_user_image"
                                                                src="{{ asset($user->sender->image) }}" alt="user"
                                                                class="img-fluid">
                                                            <span class="pending d-none" id="pending-6">0</span>
                                                        </div>
                                                        <div class="wsus_chat_list_text">
                                                            <h4 id="chat_user_name">{{ $user->sender->name }}</h4>
                                                        </div>
                                                    </button>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-7">
                                    <div class="wsus__chat_main_area" style="position: relative; height: 88vh;">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show" id="v-pills-home" role="tabpanel"
                                                aria-labelledby="v-pills-home-tab">
                                                <div id="chat_box">
                                                    <div class="wsus__chat_area">
                                                        <div class="wsus__chat_area_header">
                                                            <h2 id="chat_with">Start To Chat</h2>
                                                        </div>
                                                        <div class="wsus__chat_area_body" data-inbox="">
                                                            {{-- Fetching Chat Here --}}
                                                        </div>
                                                        <div class="wsus__chat_area_footer"
                                                            style="margin-top: 50px; position: absolute; width: 100%; bottom:0;">
                                                            <form id="customerToSellerMsgForm">
                                                                @csrf
                                                                <input type="text" placeholder="Type Message"
                                                                    id="message" name="message" autocomplete="off">
                                                                <input type="hidden" name="receiver_id" id="receiver_id"
                                                                    value="">
                                                                <input type="hidden" name="sender_id"
                                                                    value="{{ auth()->user()->id }}">
                                                                <button type="submit submit_message_btn"><i
                                                                        class="fas fa-paper-plane"
                                                                        aria-hidden="true"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        var chatBox = $('.wsus__chat_area_body');

        // Date Function
        function formatDateTime(date) {
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
            };
            const formatedDateTime = new Intl.DateTimeFormat('en-Us', options).format(new Date(date));
            return formatedDateTime;
        }
        // Scroll Automatic to the Bottom
        function ScrollToBottom() {
            chatBox.scrollTop(chatBox.prop("scrollHeight"));
        }
        $(document).ready(function() {
            // Fetching Chat User
            $(document).on('click', '.chat_user_profile', function() {
                let senderID = $(this).attr('data-id');
                let chatUserName = $(this).find('#chat_user_name').text();
                $('#receiver_id').val(senderID);
                $(this).find('.wsus_chat_list_img').removeClass('msg-notification');
                chatBox.attr('data-inbox', senderID);
                chatBox.html("");

                $.ajax({
                    method: 'GET',
                    data: {
                        senderID: senderID
                    },
                    url: '{{ route('vendor.fetch.user.chat') }}',
                    beforeSend: function() {

                    },
                    success: function(response) {
                        $('#chat_with').text(chatUserName);
                        let html = '';
                        $.each(response.chat, function(index, value) {
                            if (value.sender_id != USER.id) {
                                html += `
                                <div class="wsus__chat_single single_chat_2 ">
                                    <div class="wsus__chat_single_img">
                                        <img src="${USER.image}" alt="user" class="img-fluid">
                                    </div>
                                    <div class="wsus__chat_single_text">
                                        <p>${value.message}</p>
                                        <span>${formatDateTime(value.created_at)}</span>
                                    </div>
                                </div>
                            `;
                            } else {
                                html += `
                                <div class="wsus__chat_single">
                                    <div class="wsus__chat_single_img">
                                        <img src="${response.senderImage}" alt="user" class="img-fluid">
                                    </div>
                                    <div class="wsus__chat_single_text">
                                        <p>${value.message}</p>
                                        <span>${formatDateTime(value.created_at)}</span>
                                    </div>
                                </div>
                            `;
                            }
                        });
                        chatBox.append(html);
                        ScrollToBottom();
                    },


                    error: function(xhr, status, error) {},
                    complete: function() {},
                })
            });
            // Send Message
            $(document).on('submit', '#customerToSellerMsgForm', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let message = $('#message').val();
                let formSubmitting = false;
                if (message == '' || formSubmitting) {
                    return;
                }

                $.ajax({
                    method: 'POST',
                    data: formData,
                    url: '{{ route('vendor.send.message') }}',
                    beforeSend: function() {
                        $('.submit_message_btn').prop('disabled', true);
                    },
                    success: function(response) {
                        $('#message').val('');
                        let html = `
                                <div class="wsus__chat_single single_chat_2">
                                    <div class="wsus__chat_single_img">
                                        <img src="${USER.image}" alt="user" class="img-fluid">
                                    </div>
                                    <div class="wsus__chat_single_text">
                                        <p>${response.message}</p>
                                        <span>${formatDateTime(response.created_at)}</span>
                                    </div>
                                </div>
                            `;

                        chatBox.append(html);
                        ScrollToBottom();
                    },
                    error: function(xhr, status, error) {},

                    complete: function() {
                        $('.submit_message_btn').addClass('d-none');
                    },
                });
            });
        });
    </script>
@endpush
