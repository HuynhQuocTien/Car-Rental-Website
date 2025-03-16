document.addEventListener('DOMContentLoaded', function () {
    const chatIcon = document.getElementById('chat-icon');
    const chatBox = document.getElementById('chat-box');
    const closeChat = document.getElementById('close-chat');
    const chatBody = document.getElementById('chat-body');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');

    // Mở chat box
    chatIcon.addEventListener('click', function () {
        chatBox.classList.add('active');
    });

    // Đóng chat box
    closeChat.addEventListener('click', function () {
        chatBox.classList.remove('active');
    });

    // Gửi tin nhắn
    sendButton.addEventListener('click', function () {
        const message = chatInput.value.trim();
        if (message) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', 'sent');
            messageElement.textContent = message;
            chatBody.appendChild(messageElement);
            chatInput.value = '';
            chatBody.scrollTop = chatBody.scrollHeight; // Cuộn xuống dưới cùng
        }
    });

    // Gửi tin nhắn khi nhấn Enter
    chatInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            sendButton.click();
        }
    });
});