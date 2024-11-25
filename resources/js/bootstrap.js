import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: PUSHER.key,
    cluster: PUSHER.cluster ?? "mt1",
    wsHost: import.meta.env.VITE_PUSHER_HOST
        ? import.meta.env.VITE_PUSHER_HOST
        : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
});

var chatBox = $(".chat-content");

// Scroll Automatic to the Bottom
function ScrollToBottom() {
    chatBox.scrollTop(chatBox.prop("scrollHeight"));
}
// Date Function
function formatDateTime(date) {
    const options = {
        year: "numeric",
        month: "short",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
    };
    const formatedDateTime = new Intl.DateTimeFormat("en-Us", options).format(
        new Date(date)
    );
    return formatedDateTime;
}
window.Echo.private("message." + USER.id).listen("MessengerEvent", (e) => {
    if(e.sender_id == chatBox.attr('data-inbox')){
        let html = `
            <div class="chat-item chat-left">
                <img src="${e.image}">
                <div class="chat-details">
                    <div class="chat-text">${e.message}</div>
                    <div class="chat-time">${formatDateTime(e.date)}</div>
                </div>
            </div>`;
        chatBox.append(html); // Append the message only to the intended user
        ScrollToBottom();
    }
    $('.chat_user_profile').each(function(){
        if(e.sender_id == $('.chat_user_profile').attr('data-id')){
           let notification = '<div class="text-warning text-small font-600-bold notification_class">New Message</div>';
            $(this).append(notification);
        }
    });

});

