<link rel="stylesheet" href="./assets/css/admin.css">

<div class="main-content p-4">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold">Chi Tiết Hướng Dẫn Viên</h3>
        <a href="?action=admin-listGuide" class="btn btn-secondary" style="text-decoration:none">← Quay lại</a>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Thông Tin Hướng Dẫn Viên</div>
        <div class="card-body d-flex">

            <?php if (!empty($guide['avatar'])): ?>
                <img src="<?= BASE_ASSETS_UPLOADS . $guide['avatar'] ?>" width="120" class="rounded me-4 shadow-sm">
            <?php else: ?>
                <div class="no-avatar me-4"
                    style="width:120px;height:120px;background:#eee;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <span>Không ảnh</span>
                </div>
            <?php endif; ?>

            <div>
                <p><strong>Họ tên:</strong> <?= $guide['name'] ?></p>
                <p><strong>Email:</strong> <?= $guide['email'] ?></p>
                <p><strong>Số điện thoại:</strong> <?= $guide['phone'] ?></p>
                <p><strong>Căn cước công dân:</strong> <?= $guide['cccd'] ?></p>
                <p><strong>Chuyên môn:</strong> <?= $guide['specialization'] ?></p>
                <p><strong>Kinh nghiệm:</strong> <?= $guide['experience_years'] ?> năm</p>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Tour Đang Dẫn</div>
        <div class="card-body">

            <?php if (!empty($currentBookings)): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã Booking</th>
                            <th>Tên Tour</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($currentBookings as $b): ?>
                            <tr>
                                <td>#<?= $b['booking_id'] ?></td>
                                <td class="fw-semibold"><?= $b['tour_name'] ?></td>
                                <td><?= date("d/m/Y", strtotime($b['start_date'])) ?></td>
                                <td><?= empty($b['end_date']) ? '' : date("d/m/Y", strtotime($b['end_date'])) ?></td>
                                <td>
                                    <a href="?action=admin-detailBooking&id=<?= $b['booking_id'] ?>"
                                        class="btn btn-info btn-sm">Chi tiết</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php else: ?>
                <p class="text-muted">Hướng dẫn viên chưa được phân tour nào.</p>
            <?php endif; ?>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Lịch Sử Dẫn Tour</div>
        <div class="card-body">

            <?php if (!empty($historyBookings)): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã Booking</th>
                            <th>Tên Tour</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historyBookings as $b): ?>
                            <tr>
                                <td>#<?= $b['booking_id'] ?></td>
                                <td class="fw-semibold"><?= $b['tour_name'] ?></td>
                                <td><?= date("d/m/Y", strtotime($b['start_date'])) ?></td>
                                <td><?= date("d/m/Y", strtotime($b['end_date'])) ?></td>
                                <td>
                                    <?php if ($b['booking_status'] == 'da_hoan_thanh'): ?>
                                        <span class="badge bg-success">Hoàn thành</span>
                                    <?php elseif ($b['booking_status'] == 'da_huy'): ?>
                                        <span class="badge bg-danger">Đã hủy</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php else: ?>
                <p class="text-muted">Chưa có lịch sử dẫn tour.</p>
            <?php endif; ?>

        </div>
    </div>

</div>