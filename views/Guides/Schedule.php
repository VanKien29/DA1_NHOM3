<div class="admin-table-container">
    <h3 class="fw-bold mb-3">Lịch Tour của Tôi</h3>
    <form method="GET">
        <input type="hidden" name="action" value="guide-schedule">

        <select name="filter" class="form-select filter-select" onchange="this.form.submit()">
            <option value="">-- Lọc theo thời gian --</option>

            <optgroup label="Ngày tới">
                <option value="today" <?= ($_GET['filter'] ?? '') == 'today' ? 'selected' : '' ?>>Hôm nay</option>
                <option value="3days" <?= ($_GET['filter'] ?? '') == '3days' ? 'selected' : '' ?>>3 ngày tới</option>
                <option value="7days" <?= ($_GET['filter'] ?? '') == '7days' ? 'selected' : '' ?>>7 ngày tới</option>
                <option value="1month" <?= ($_GET['filter'] ?? '') == '1month' ? 'selected' : '' ?>>1 tháng tới</option>
            </optgroup>

            <optgroup label="Ngày trước">
                <option value="yesterday" <?= ($_GET['filter'] ?? '') == 'yesterday' ? 'selected' : '' ?>>Hôm qua
                </option>
                <option value="3days_ago" <?= ($_GET['filter'] ?? '') == '3days_ago' ? 'selected' : '' ?>>3 ngày trước
                </option>
                <option value="7days_ago" <?= ($_GET['filter'] ?? '') == '7days_ago' ? 'selected' : '' ?>>7 ngày trước
                </option>
                <option value="1month_ago" <?= ($_GET['filter'] ?? '') == '1month_ago' ? 'selected' : '' ?>>1 tháng
                    trước</option>
            </optgroup>
        </select>
    </form>

    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tour</th>
                <th>Khách Sạn</th>
                <th>Phương Tiện</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Khách</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php $i=1; foreach($schedule as $item): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $item['tour_name'] ?></td>
                <td><?= $item['hotel_name'] ?></td>
                <td><?= $item['vehicle_name'] ?></td>
                <td><?= $item['start_date'] ?></td>
                <td><?= $item['end_date'] ?></td>
                <td>
                    <?php
                        switch ($item['status']) {
                            case 'sap_dien_ra':
                                echo "<span class='badge bg-info'>Sắp diễn ra</span>";
                                break;
                            case 'dang_dien_ra':
                                echo "<span class='badge bg-success'>Đang diễn ra</span>";
                                break;
                            case 'cho_xac_nhan_ket_thuc':
                                echo "<span class='badge bg-warning text-dark'>Chờ xác nhận</span>";
                                break;
                            case 'da_hoan_thanh':
                                echo "<span class='badge bg-primary'>Đã hoàn thành</span>";
                                break;
                            case 'da_huy':
                                echo "<span class='badge bg-danger'>Đã hủy</span>";
                                break;
                        }
                    ?>
                </td>
                <td><?= $item['total_customers'] ?></td>
                <td>
                    <a href="?action=guide-detailGuideBooking&id=<?= $item['booking_id'] ?>"
                        class="btn btn-sm btn-primary">
                        Xem chi tiết
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>