var chatBox = $('.wsus__chat_area_body');

// Scroll Automatic to the Bottom
function ScrollToBottom() {
    chatBox.scrollTop(chatBox.prop("scrollHeight"));
}
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
window.Echo.private("message."+USER.id).listen(
    "MessengerEvent",
    (e) => {
         if(chatBox.attr('data-inbox') == e.sender_id){
            let html = `
             <div class="wsus__chat_single">
                 <div class="wsus__chat_single_img">
                     <img src="${e.image}" alt="user" class="img-fluid">
                 </div>
                 <div class="wsus__chat_single_text">
                     <p>${e.message}</p>
                     <span>${formatDateTime(e.date)}</span>
                 </div>
             </div>
         `;
         chatBox.append(html);
         ScrollToBottom();
        }
        $('.chat_user_profile').each(function(){
            if(e.sender_id == $(this).attr('data-id')){
                $(this).find('.wsus_chat_list_img').addClass('msg-notification');
            }
        });
    });



