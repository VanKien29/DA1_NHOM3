<div class="main-content p-4">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold">Chi Tiết Booking #<?= $booking['booking_id'] ?></h3>
        <a href="?action=admin-listBooking" class="btn btn-secondary">← Quay lại</a>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Thông Tin Booking</div>
        <div class="card-body">

            <p><strong>Mã Booking:</strong> <?= $booking['booking_id'] ?></p>
            <p><strong>Tour:</strong> <?= $booking['tour_name'] ?></p>
            <p><strong>Ngày tạo:</strong> <?= $booking['created_at'] ?></p>
            <p><strong>Số ngày:</strong> <?= $booking['days'] ?></p>
            <p><strong>Số đêm:</strong> <?= $booking['nights'] ?></p>

            <p><strong>Trạng thái:</strong>
                <?php if ($booking['status'] == 'pending'): ?>
                <span class="badge bg-warning text-dark">Chờ duyệt</span>
                <?php elseif ($booking['status'] == 'confirmed'): ?>
                <span class="badge bg-success">Đã xác nhận</span>
                <?php elseif ($booking['status'] == 'completed'): ?>
                <span class="badge bg-primary">Hoàn thành</span>
                <?php else: ?>
                <span class="badge bg-danger">Đã hủy</span>
                <?php endif; ?>
            </p>

            <p><strong>Ghi chú:</strong><br>
                <?= nl2br($booking['report'] ?? '—'); ?>
            </p>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Hướng Dẫn Viên Phụ Trách</div>
        <div class="card-body">

            <?php if ($guide): ?>
            <p><strong>Họ tên:</strong> <?= $guide['guide_name'] ?></p>
            <p><strong>Email:</strong> <?= $guide['email'] ?></p>
            <p><strong>SĐT:</strong> <?= $guide['phone'] ?></p>
            <p><strong>Chuyên môn:</strong> <?= $guide['specialization'] ?></p>
            <p><strong>Kinh nghiệm:</strong> <?= $guide['experience_years'] ?> năm</p>
            <p><strong>Ngày bắt đầu:</strong> <?= $guide['start_date'] ?></p>
            <p><strong>Ngày kết thúc:</strong> <?= $guide['end_date'] ?></p>

            <p><strong>Trạng thái:</strong>
                <span class="badge bg-info"><?= $guide['status'] ?></span>
            </p>

            <?php else: ?>
            <p class="text-danger">Chưa phân hướng dẫn viên cho tour này.</p>
            <?php endif; ?>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Danh Sách Khách Đi Cùng</div>
        <div class="card-body">

            <?php if (count($customers) > 0): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $c): ?>
                    <tr>
                        <td><?= $c['full_name'] ?></td>
                        <td><?= $c['email'] ?></td>
                        <td><?= $c['phone'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p class="fw-bold mt-3">Tổng số khách: <?= count($customers) ?> người</p>

            <?php else: ?>
            <p class="text-muted">Chưa thêm khách nào cho booking này.</p>
            <?php endif; ?>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Tình Trạng Điểm Danh</div>
        <div class="card-body">

            <?php if (count($attendance) > 0): ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendance as $a): ?>
                    <tr>
                        <td><?= $a['full_name'] ?></td>
                        <td>
                            <?php if ($a['status'] == 'present'): ?>
                            <span class="badge bg-success">Có mặt</span>
                            <?php else: ?>
                            <span class="badge bg-danger">Vắng</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $a['note'] ?: '—' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- 
            <p class="fw-bold mt-3">
                Có mặt: <?= count(array_filter($attendance, fn($x) => $x['status'] == 'present')) ?> /
                <?= count($attendance) ?> khách
            </p> -->

            <?php else: ?>
            <p class="text-muted">Chưa có dữ liệu điểm danh.</p>
            <?php endif; ?>

        </div>
    </div>

</div>