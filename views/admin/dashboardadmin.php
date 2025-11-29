<?php
// ... (Code session start và check admin giữ nguyên như cũ)
include('../shared/header.php'); // Dùng header mới
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group shadow-sm">
                <a href="#" class="list-group-item list-group-item-action active">Tổng quan</a>
                <a href="manage_tours.php" class="list-group-item list-group-item-action">Quản lý Tour</a>
                <a href="manage_users.php" class="list-group-item list-group-item-action">Quản lý Người dùng</a>
                <a href="manage_bookings.php" class="list-group-item list-group-item-action">Quản lý Đặt chỗ <span
                        class="badge bg-danger float-end">Mới</span></a>
            </div>
        </div>

        <div class="col-md-9">
            <h2 class="mb-4">Bảng điều khiển</h2>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3 shadow">
                        <div class="card-body">
                            <h5 class="card-title">Tổng Tour</h5>
                            <p class="card-text display-4 fw-bold">12</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3 shadow">
                        <div class="card-body">
                            <h5 class="card-title">Doanh thu tháng</h5>
                            <p class="card-text display-6 fw-bold">52tr</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3 shadow">
                        <div class="card-body">
                            <h5 class="card-title">Khách hàng mới</h5>
                            <p class="card-text display-4 fw-bold">150</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">Thống kê đặt tour theo tháng</div>
                <div class="card-body">
                    <canvas id="bookingChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('bookingChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
        datasets: [{
            label: 'Số lượng đặt tour',
            data: [12, 19, 3, 5, 2, 30],
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            fill: false
        }]
    }
});
</script>
</body>

</html>