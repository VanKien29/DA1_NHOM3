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
                        <th>Số ngày</th>
                        <th>Số đêm</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; foreach ($bookings as $b): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $b['booking_id']; ?></td>
                        <td><?= htmlspecialchars($b['tour_name'] ?? 'Không có'); ?></td>
                        <td><?= htmlspecialchars($b['hotel_name'] ?? 'Không chọn'); ?></td>
                        <td><?= htmlspecialchars($b['vehicle_name'] ?? 'Không chọn'); ?></td>
                        <td>
                            <?php if ($b['status'] == 'pending'): ?>
                            <span class="badge bg-warning text-dark">Chờ duyệt</span>

                            <?php elseif ($b['status'] == 'confirmed'): ?>
                            <span class="badge bg-success">Đã xác nhận</span>

                            <?php elseif ($b['status'] == 'completed'): ?>
                            <span class="badge bg-primary">Hoàn thành</span>

                            <?php else: ?>
                            <span class="badge bg-danger">Đã hủy</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($b['created_at'])); ?></td>

                        <td><?= $b['days']; ?></td>
                        <td><?= $b['nights']; ?></td>
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