// Tự động cuộn xuống khi có tin nhắn mới trong chat
function scrollToBottom() {
    var chatBox = document.getElementById('messages');
    chatBox.scrollTop = chatBox.scrollHeight; // Cuộn xuống dưới cùng của chatbox
}

// Gửi tin nhắn
document.getElementById('sendMessage').onclick = function() {
    var message = document.getElementById('messageInput').value.trim(); // Lấy giá trị tin nhắn và loại bỏ khoảng trắng thừa
    if (message !== '') {
        var messageDiv = document.createElement('div');
        messageDiv.classList.add('message');  // Thêm lớp 'message' để dễ dàng CSS hóa
        messageDiv.textContent = message;

        // Tạo một div mới cho tin nhắn và thêm vào hộp chat
        document.getElementById('messages').appendChild(messageDiv);
        document.getElementById('messageInput').value = ''; // Xóa ô nhập sau khi gửi

        // Cuộn xuống dưới cùng của hộp chat
        scrollToBottom();

        // Cập nhật trạng thái tin nhắn là "đã gửi"
        updateMessageStatus(messageDiv, 'sent');
    }
};

// Cập nhật trạng thái tin nhắn (mới gửi, chưa đọc, v.v.)
function updateMessageStatus(messageDiv, status) {
    if (status === 'sent') {
        messageDiv.classList.add('sent');  // Thêm lớp 'sent' để CSS hóa tin nhắn đã gửi
    } else if (status === 'read') {
        messageDiv.classList.add('read');  // Thêm lớp 'read' để CSS hóa tin nhắn đã đọc
    }
}

// Chỉnh sửa sự kiện để khi nhấn 'Enter' có thể gửi tin nhắn
document.getElementById('messageInput').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        document.getElementById('sendMessage').click();
    }
});
