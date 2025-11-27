// Tự động cuộn xuống khi có tin nhắn mới trong chat
function scrollToBottom() {
    var chatBox = document.getElementById('messages');
    chatBox.scrollTop = chatBox.scrollHeight;
}

// Gửi tin nhắn
document.getElementById('sendMessage').onclick = function() {
    var message = document.getElementById('messageInput').value;
    if (message.trim() !== '') {
        var messageDiv = document.createElement('div');
        messageDiv.textContent = message;
        document.getElementById('messages').appendChild(messageDiv);
        document.getElementById('messageInput').value = ''; // Xóa ô nhập sau khi gửi

        scrollToBottom(); // Cuộn xuống cuối
    }
};

// Cập nhật trạng thái tin nhắn (mới gửi, chưa đọc, v.v.)
function updateMessageStatus(messageId, status) {
    var message = document.getElementById(messageId);
    message.classList.add(status); // Thêm lớp trạng thái như 'new', 'read', v.v.
}
