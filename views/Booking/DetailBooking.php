<?php 
$start = strtotime($booking['start_date']);
$end   = strtotime($booking['end_date']);
$total_days  = ($end - $start) / 86400 + 1;
$total_nights = $total_days - 1;

$segments = $this->bookingQuery->getSegmentCustomersByBooking($booking['booking_id']);

// nhóm chặng
$grouped = [];
foreach ($segments as $s) {
    $grouped[$s['tour_schedule_id']][] = $s;
}
?>

<div class="main-content p-4">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold">Chi Tiết Booking #<?= $booking['booking_id'] ?></h3>
        <a href="?action=admin-listBooking" class="btn btn-secondary" style="text-decoration:none">← Quay lại</a>
    </div>

    <div class="booking-layout">
        <!-- ================= LEFT ================= -->
        <div class="left-column">
            <!-- Thông tin Booking -->
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông Tin Booking</div>
                <div class="card-body">
                    <p><strong>Mã Booking:</strong> <?= $booking['booking_id'] ?></p>
                    <p><strong>Tour:</strong> <?= $booking['tour_name'] ?></p>

                    <p><strong>Ngày bắt đầu:</strong> <?= date('d/m/Y', strtotime($booking['start_date'])) ?></p>
                    <p><strong>Ngày kết thúc:</strong> <?= date('d/m/Y', strtotime($booking['end_date'])) ?></p>

                    <p>
                        <strong>Ngày/đêm: </strong>
                        <?= $total_days ?> ngày <?= $total_nights > 0 ? "/ $total_nights đêm" : "" ?>
                    </p>

                    <p><strong>Tổng giá:</strong>
                        <?= number_format($booking['total_price'] ?? 0) ?> VND
                    </p>

                    <p><strong>Trạng thái:</strong>
                        <?php if ($booking['status'] == 'sap_dien_ra'): ?>
                        <span class="badge bg-warning">Sắp diễn ra</span>
                        <?php elseif ($booking['status'] == 'dang_dien_ra'): ?>
                        <span class="badge bg-success">Đang diễn ra</span>
                        <?php elseif ($booking['status'] == 'cho_xac_nhan_ket_thuc'): ?>
                        <span class="badge bg-info">Chờ xác nhận</span>
                        <?php elseif ($booking['status'] == 'da_hoan_thanh'): ?>
                        <span class="badge bg-primary">Đã hoàn thành</span>
                        <?php elseif ($booking['status'] == 'da_huy'): ?>
                        <span class="badge bg-danger">Đã hủy</span>
                        <?php endif; ?>
                    </p>

                    <p><strong>Ghi chú:</strong> <?= $booking['note'] ?: '—' ?></p>
                </div>
            </div>

            <!-- Hướng dẫn viên -->
            <div class="card mb-4">
                <div class="card-header fw-bold">Hướng Dẫn Viên</div>
                <div class="card-body">
                    <?php if ($guide): ?>
                    <p><strong>Họ tên:</strong> <?= $guide['guide_name'] ?></p>
                    <p><strong>Email:</strong> <?= $guide['email'] ?></p>
                    <p><strong>SĐT:</strong> <?= $guide['phone'] ?></p>
                    <p><strong>Chuyên môn:</strong> <?= $guide['specialization'] ?></p>
                    <p><strong>Kinh nghiệm:</strong> <?= $guide['experience_years'] ?> năm</p>
                    <?php else: ?>
                    <p class="text-danger">Chưa có hướng dẫn viên.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- ================= RIGHT ================= -->
        <div class="right-column">
            <!-- Khách sạn -->
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông Tin Khách Sạn</div>
                <div class="card-body">
                    <p><strong>Tên khách sạn:</strong> <?= $booking['hotel_name'] ?></p>
                    <p><strong>Người đại diện:</strong> <?= $booking['hotel_manager'] ?></p>
                    <p><strong>SĐT:</strong> <?= $booking['hotel_manager_phone'] ?></p>
                    <p><strong>Giá/người/đêm:</strong> <?= number_format($booking['price_per_night']) ?> VND</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header fw-bold">Phương Tiện Theo Lịch Trình</div>
                <div class="card-body">
                    <?php if (!empty($segments_grouped)): ?>
                    <?php foreach ($segments_grouped as $sid => $seg): ?>
                    <div class="segment-accordion">
                        <div class="segment-header" onclick="toggleSegment(<?= $sid ?>)">
                            <div>
                                <strong>Ngày <?= $seg['day_number'] ?></strong> – <?= $seg['title'] ?>
                            </div>
                            <div class="arrow" id="arrow-<?= $sid ?>">▼</div>
                        </div>

                        <div class="segment-content" id="segment-<?= $sid ?>">
                            <?php if ($seg['vehicle']): ?>
                            <p><strong>Xe sử dụng:</strong> <?= $seg['vehicle'] ?></p>
                            <p><strong>Giá chặng:</strong> <?= number_format($seg['price_per_day']) ?> VND</p>

                            <?php if (!empty($seg['using'])): ?>
                            <p><strong>Khách sử dụng xe:</strong></p>
                            <table class="segment-table">
                                <thead>
                                    <tr>
                                        <th>Khách hàng</th>
                                        <th>Giá theo chặng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($seg['using'] as $u): ?>
                                    <tr>
                                        <td><?= $u['full_name'] ?></td>
                                        <td><?= number_format($u['segment_price_per_customer']) ?> VND</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>

                            <?php if (!empty($seg['excluded'])): ?>
                            <p><strong>Khách không sử dụng xe:</strong></p>
                            <table class="segment-table">
                                <thead>
                                    <tr>
                                        <th>Khách hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($seg['excluded'] as $e): ?>
                                    <tr>
                                        <td><?= $e['full_name'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                            <?php else: ?>
                            <p class="text-muted">Chặng này không sử dụng phương tiện.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="text-muted">Không có dữ liệu phương tiện theo lịch trình.</p>
                    <?php endif; ?>
                </div>
            </div>

            <script>
            function toggleSegment(id) {
                const box = document.getElementById("segment-" + id);
                const arrow = document.getElementById("arrow-" + id);

                if (box.classList.contains("open")) {
                    box.classList.remove("open");
                    arrow.innerHTML = "▼";
                } else {
                    box.classList.add("open");
                    arrow.innerHTML = "▲";
                }
            }
            </script>
        </div>
    </div>

    <!-- ================= LỊCH TRÌNH TOUR ================= -->
    <div class="card mb-4">
        <div class="card-header fw-bold">Lịch Trình Tour</div>
        <div class="card-body">
            <div class="schedule-wrapper">
                <?php foreach ($tour_schedules as $schedule): ?>
                <div class="schedule-item">
                    <div class="schedule-day">Ngày <?= $schedule['day_number'] ?></div>
                    <div class="schedule-line"></div>
                    <div class="schedule-content">
                        <p class="schedule-title"><?= $schedule['title'] ?></p>
                        <p class="schedule-desc"><?= $schedule['description'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- ================= DANH SÁCH KHÁCH ================= -->
    <div class="customer-table-wrapper">
        <h4 class="fw-bold mb-3">Danh Sách Khách</h4>
        <?php if($booking['status'] == 'sap_dien_ra'):?>
        <button class="btn btn-addCustomer" onclick="document.getElementById('addCustomerForm').style.display='block'">
            + Thêm khách
        </button>
        <?php endif; ?>
        <table class="customer-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Điểm danh</th>
                    <th>Ghi chú</th>
                    <th><?php if($booking['status'] == 'sap_dien_ra'){ echo 'Hành động'; } ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $c): ?>
                <tr>
                    <td><?= $c['customer_id'] ?></td>
                    <td>
                        <?= $c['full_name'] ?>
                        <?php if ($c['is_main']): ?>
                        <span class="badge bg-primary">Chính</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $c['email'] ?></td>
                    <td><?= $c['phone'] ?></td>
                    <td>
                        <?php 
                                $att = null;
                                foreach ($attendance as $a) {
                                    if ($a['customer_id'] == $c['customer_id']) $att = $a;
                                }
                            ?>
                        <?php if ($att): ?>
                        <?php if ($att['status'] == 'present'): ?>
                        <span class="badge-present">Có mặt</span>
                        <?php elseif ($att['status'] == 'absent'): ?>
                        <span class="badge-absent">Vắng</span>
                        <?php else: ?>
                        <span class="badge-none">—</span>
                        <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $att['note'] ?? '' ?></td>
                    <?php if($booking['status'] == 'sap_dien_ra'): ?>
                    <td class="action-col">
                        <a href="?action=admin-deleteCustomerBooking&id=<?= $c['bc_id'] ?>&booking_id=<?= $booking['booking_id'] ?>"
                            class="btn-delete" onclick="return confirm('Xoá khách này?')">
                            Xoá
                        </a>
                    </td>
                </tr>
                <?php endif; endforeach; ?>
            </tbody>
        </table>
        <p class="fw-bold mt-3">Tổng số khách: <?= count($customers) ?> người</p>
        <div id="addCustomerForm" style="display:none;" class="border rounded p-3 mb-3 bg-light">
            <form method="POST">
                <input type="hidden" name="action_add_customer" value="1">
                <label class="fw-semibold">Chọn khách để thêm: </label>
                <select name="add_customer_id" class="form-select mb-3">
                    <option value="">-- Chọn khách --</option>
                    <?php foreach ($customers_all as $c): ?>
                    <option value="<?= $c['customer_id'] ?>">
                        <?= $c['customer_id'] ?> -
                        <?= $c['full_name'] ?> - <?= $c['phone'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-secondary">Lưu khách</button>
                <button type="button" class="btn btn-exitCustomer"
                    onclick="document.getElementById('addCustomerForm').style.display='none'">Hủy</button>
            </form>
        </div>
    </div>

    <?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-success fade-alert">
        <?= $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger fade-alert">
        <?= $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

</div>