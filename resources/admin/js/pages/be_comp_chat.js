/*
 *  Document   : be_comp_chat.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Chat Page
 */

// Helper variables
let cMessages, cform;

// Message Classes
let classesMsgBase      = 'd-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100',
    classesMsgSelf      = 'border-right border-primary rounded-left text-left',
    classesMsgOther     = 'border-left border-dark rounded-right',
    classesMsgHeader    = 'font-size-sm font-italic text-muted animated fadeIn my-2';

class pageCompChat {
    /*
     * Init chat
     *
     */
    static initChat() {
        let self = this;

        // Set variables
        cMessages  = jQuery('.js-chat-messages');
        cform      = jQuery('.js-chat-form');

        // Init form submission
        jQuery('form', cform).on('submit', e => {
            // Stop form submission
            e.preventDefault();

            // Get chat input
            let chatInput = jQuery('.js-chat-input', jQuery(e.currentTarget));

            // Add message
            self.chatAddMessage(chatInput.data('target-chat-id'), chatInput.val(), 'self', chatInput);
        });
    }

    /*
     * Add a header message to a chat window
     *
     */
    static chatAddHeader(chatId, chatMsg, chatMsgLevel) {
        // Get chat messages window
        let chatWindow = jQuery('.js-chat-messages[data-chat-id="' + chatId + '"]');

        // If header and chat window exists
        if (chatMsg && chatWindow.length) {
            chatWindow.append(
                '<div class="' + classesMsgHeader + ((chatMsgLevel === 'self') ? ' text-right' : '') + '">'
                    + jQuery('<div />').text(chatMsg).html()
                + '</div>'
            );

            // Scroll the message list to the bottom
            chatWindow.animate({ scrollTop: chatWindow[0].scrollHeight }, 150);
        }
    }

    /*
     * Add a message to a chat window
     *
     */
    static chatAddMessage(chatId, chatMsg, chatMsgLevel, chatInput) {
        // Get chat messages window
        let chatWindow = jQuery('.js-chat-messages[data-chat-id="' + chatId + '"]');

        // If message and chat window exists
        if (chatMsg && chatWindow.length) {
            // Post it to its related window (if message level is 'self', make it stand out)
            chatWindow.append(
                '<div class="' + ((chatMsgLevel === 'self') ? 'text-right ml-4' : 'mr-4') + '">'
                    + '<div class="' + classesMsgBase + ' ' + ((chatMsgLevel === 'self') ? classesMsgSelf : classesMsgOther) + '">'
                        + jQuery('<div />').text(chatMsg).html()
                    + '</div>',
                + '</div>'
            );

            // Scroll the message list to the bottom
            chatWindow.animate({ scrollTop: chatWindow[0].scrollHeight }, 200);

            // If input is set, reset it
            if (chatInput) {
                chatInput.val('');
            }
        }
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initChat();
    }

    /*
     * Add header
     *
     */
    static addHeader(chatId, chatMsg, chatMsgLevel = '') {
        this.chatAddHeader(chatId, chatMsg, chatMsgLevel);
    }

    /*
     * Add message
     *
     */
    static addMessage(chatId, chatMsg, chatMsgLevel = '') {
        this.chatAddMessage(chatId, chatMsg, chatMsgLevel, false);
    }
}

// Initialize when page loads
jQuery(() => {
    pageCompChat.init();
    window.Chat = pageCompChat;
});
