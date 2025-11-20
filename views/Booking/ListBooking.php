<div class="main-content p-4">
    <div class="table-container">
        <div class="admin-table-container">

            <div class="table-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Danh Sách Booking</h4>
                <a href="?action=admin-createBooking" class="btn btn-primary">
                    + Thêm Booking
                </a>
            </div>

            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Tour</th>
                        <th>Khách sạn</th>
                        <th>Phương tiện</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th style="text-align: center;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; foreach ($bookings as $b): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $b['booking_id']; ?></td>
                        <td><?= htmlspecialchars($b['tour_name']); ?></td>
                        <td><?= htmlspecialchars($b['hotel_name']); ?></td>
                        <td><?= htmlspecialchars($b['vehicle_name']); ?></td>
                        <td>
                            <?php if ($b['status'] == 'cho_duyet'): ?>
                            <span class="badge bg-warning text-dark">Chờ duyệt</span>
                            <?php elseif ($b['status'] == 'dang_dien_ra'): ?>
                            <span class="badge bg-primary">Đang diễn ra</span>
                            <?php elseif ($b['status'] == 'cho_hdv_xac_nhan'): ?>
                            <span class="badge bg-info text-dark">Chờ HDV xác nhận</span>
                            <?php elseif ($b['status'] == 'da_hoan_thanh'): ?>
                            <span class="badge bg-success">Đã hoàn thành</span>
                            <?php elseif ($b['status'] == 'da_huy'): ?>
                            <span class="badge bg-danger">Đã hủy</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($b['created_at'])); ?></td>
                        <td><?= date('d/m/Y', strtotime($b['start_date'])); ?></td>
                        <td><?= date('d/m/Y', strtotime($b['end_date'])); ?></td>
                        <td>
                            <a href="?action=admin-detailBooking&id=<?= $b['booking_id']; ?>"
                                class="btn btn-sm btn-info">Chi tiết</a>
                            <a href="?action=admin-updateBooking&id=<?= $b['booking_id']; ?>"
                                class="btn btn-sm btn-outline-success">Sửa</a>
                            <a href="?action=admin-deleteBooking&id=<?= $b['booking_id']; ?>"
                                onclick="return confirm('Xác nhận xóa booking này?')"
                                class="btn btn-sm btn-outline-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>