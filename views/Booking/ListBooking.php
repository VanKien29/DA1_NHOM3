<div class="main-content p-4">
    <div class="table-container">
        <div class="admin-table-container">

            <div class="table-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Danh Sách Booking</h4>
                <a href="?action=admin-createBooking" class="btn btn-primary">
                    + Thêm Booking
                </a>
            </div>
            <div class="d-flex gap-2 mb-3">
                <form method="GET">
                    <input type="hidden" name="action" value="admin-listBooking">

                    <select name="filter" class="form-select filter-select" onchange="this.form.submit()">
                        <option value="">-- Lọc theo thời gian --</option>

                        <optgroup label="Ngày tới">
                            <option value="today" <?= ($_GET['filter'] ?? '') == 'today' ? 'selected' : '' ?>>Hôm nay
                            </option>
                            <option value="3days" <?= ($_GET['filter'] ?? '') == '3days' ? 'selected' : '' ?>>3 ngày tới
                            </option>
                            <option value="7days" <?= ($_GET['filter'] ?? '') == '7days' ? 'selected' : '' ?>>7 ngày tới
                            </option>
                            <option value="1month" <?= ($_GET['filter'] ?? '') == '1month' ? 'selected' : '' ?>>1 tháng
                                tới</option>
                        </optgroup>

                        <optgroup label="Ngày trước">
                            <option value="yesterday" <?= ($_GET['filter'] ?? '') == 'yesterday' ? 'selected' : '' ?>>
                                Hôm qua</option>
                            <option value="3days_ago" <?= ($_GET['filter'] ?? '') == '3days_ago' ? 'selected' : '' ?>>3
                                ngày trước</option>
                            <option value="7days_ago" <?= ($_GET['filter'] ?? '') == '7days_ago' ? 'selected' : '' ?>>7
                                ngày trước</option>
                            <option value="1month_ago" <?= ($_GET['filter'] ?? '') == '1month_ago' ? 'selected' : '' ?>>
                                1 tháng trước</option>
                        </optgroup>
                    </select>
                </form>
            </div>

            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tour</th>
                        <th>Khách sạn</th>
                        <th>Phương tiện</th>
                        <th>HDV phụ trách</th>
                        <th>Số khách</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Ngày/Đêm</th>
                        <th>Tổng giá</th>
                        <th>Trạng thái</th>
                        <th style="text-align: center;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; foreach ($bookings as $b): 
                        $start = strtotime($b['start_date']);
                        $end   = strtotime($b['end_date']);
                        $total_days  = ($end - $start) / 86400 + 1;
                        $total_nights = $total_days - 1;   
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= htmlspecialchars($b['tour_name']); ?></td>
                        <td><?= htmlspecialchars($b['hotel_name']); ?></td>
                        <td><?= htmlspecialchars($b['vehicle_name']); ?></td>
                        <td><?= htmlspecialchars($b['guide_name']); ?></td>
                        <td><?= htmlspecialchars($b['total_customers']); ?></td>
                        <td><?= date('d/m/Y', strtotime($b['start_date'])); ?></td>
                        <td><?= empty($b['end_date']) ? '' : date('d/m/Y', strtotime($b['end_date'])); ?></td>
                        <td><?= $total_days ?> ngày / <?= $total_nights ?> đêm</td>
                        <td><?= number_format($b['total_price'], 0, ',', '.'); ?> đ</td>
                        <td>
                            <?php if ($b['status'] == 'cho_duyet'): ?>
                            <span class="badge bg-warning text-dark">Chờ duyệt</span>
                            <?php elseif ($b['status'] == 'dang_dien_ra'): ?>
                            <span class="badge bg-success">Đang diễn ra</span>
                            <?php elseif ($b['status'] == 'da_hoan_thanh'): ?>
                            <span class="badge bg-primary">Đã hoàn thành</span>
                            <?php elseif ($b['status'] == 'da_huy'): ?>
                            <span class="badge bg-danger">Đã hủy</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="?action=admin-detailBooking&id=<?= $b['booking_id']; ?>"
                                class="btn btn-sm btn-outline-detail">Chi tiết</a>
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