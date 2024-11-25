@extends('admin.layout.master')
@section('title')
    Messenger
@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Chat Box</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Components</a></div>
                    <div class="breadcrumb-item">Chat Box</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Chat Boxes</h2>


                <div class="row align-items-center justify-content-center">
                    <div class="col-md-3">
                        <div style="height: 70vh;" class="card">
                            <div class="card-header">
                                <h4>Who's Online?</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border">
                                    @foreach ($chatUsers as $user)
                                        @php
                                            $unSeenMessages = App\Models\Chat::where('sender_id', $user->sender->id)
                                                ->where('receiver_id', auth()->user()->id)
                                                ->where('status', 0)
                                                ->count();
                                        @endphp
                                        <li class="media chat_user_profile" data-id="{{ $user->sender->id }}">
                                            <img alt="image" class="mr-3 rounded-circle" width="50"
                                                src="{{ asset($user->sender->image) }}">
                                            <div class="media-body">
                                                <div class="mt-0 mb-1 font-weight-bold">{{ $user->sender->name }}</div>
                                            </div>
                                            @if ($unSeenMessages > 0)
                                            <div class="text-warning text-small font-600-bold notification_class">New Message</div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div style="height: 70vh;" class="card chat-box" id="mychatbox">
                            <div class="card-header">
                                <h4 id="chat_with">Start To Chat</h4>
                            </div>
                            <div class="card-body chat-content" data-inbox="">

                                {{-- Fetching Chat Here --}}

                            </div>
                            <div class="card-footer chat-form">
                                <form id="chat-form">
                                    @csrf
                                    <input type="text" id="message" name="message" autocomplete="off"
                                        class="form-control" placeholder="Type a message">
                                    <input type="hidden" name="receiver_id" id="receiver_id" value="">
                                    <button class="btn btn-primary">
                                        <i class="far fa-paper-plane"></i>
                                    </button>
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
        var chatBox = $('.chat-content');
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
                $('#receiver_id').val(senderID);
                chatBox.attr('data-inbox', senderID);
                $(this).find('.notification_class').addClass('d-none');
                $.ajax({
                    method: 'GET',
                    data: {
                        senderID: senderID
                    },
                    url: '{{ route('admin.fetch.user.chat') }}',
                    beforeSend: function() {
                        chatBox.html("");
                    },
                    success: function(response) {

                        if (response.status == 'success') {
                            $('#chat_with').text('Chat With ' + response.senderName);
                            let html = ''; // Initialize html as an empty string
                            $.each(response.chat, function(index, value) {
                                html += `
                                        <div class="chat-item ${value.sender_id == USER.id ? 'chat-right' : 'chat-left'}" style="">
                                            <img src="${value.sender_id == USER.id ? USER.image : value.sender.image}">
                                            <div class="chat-details">
                                                <div class="chat-text">${value.message}</div>
                                                <div class="chat-time">${formatDateTime(value.created_at)}</div>
                                            </div>
                                        </div>
                                    `;
                            });
                            chatBox.append(html); // Append the accumulated messages
                            ScrollToBottom();
                        }
                    },



                    error: function(xhr, status, error) {},
                    complete: function() {},
                })
            });
            // Send Message
            $(document).on('submit', '#chat-form', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let message = $('#message').val();
                let formSubmitting = false;
                if (message == '' || formSubmitting) {
                    return;
                }
                $('#message').val('');
                $.ajax({
                    method: 'POST',
                    data: formData,
                    url: '{{ route('admin.send.message') }}',
                    beforeSend: function() {
                        $('.submit_message_btn').prop('disabled', true);
                    },
                    success: function(response) {

                        html = `
                                        <div class="chat-item chat-right" style="">
                                            <img src="${USER.image }">
                                            <div class="chat-details">
                                                <div class="chat-text">${response.message}</div>
                                                <div class="chat-time">${formatDateTime(response.created_at)}</div>
                                            </div>
                                        </div>
                                    `;

                        chatBox.append(html); // Append the accumulated messages
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
