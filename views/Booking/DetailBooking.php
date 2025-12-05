<div class="main-content p-4">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold">Chi Tiết Booking #<?= $booking['booking_id'] ?></h3>
        <a href="?action=admin-listBooking" class="btn btn-secondary" style="text-decoration:none">← Quay lại</a>
    </div>

    <div class="booking-layout">

        <div class="left-column">
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông Tin Booking</div>
                <div class="card-body">
                    <p><strong>Mã Booking:</strong> <?= $booking['booking_id'] ?></p>
                    <p><strong>Tour:</strong> <?= $booking['tour_name'] ?></p>
                    <p><strong>Ngày bắt đầu:</strong> <?= $booking['start_date'] ?></p>
                    <p><strong>Ngày kết thúc:</strong> <?= $booking['end_date'] ?></p>
                    <p><strong>Tổng giá:</strong> <?= number_format($booking['total_price']) ?> VND</p>

                    <p><strong>Trạng thái:</strong>
                        <?php if ($booking['status'] == 'cho_duyet'): ?>
                        <span class="badge bg-warning text-dark">Chờ duyệt</span>
                        <?php elseif ($booking['status'] == 'dang_dien_ra'): ?>
                        <span class="badge bg-success">Đang diễn ra</span>
                        <?php elseif ($booking['status'] == 'da_hoan_thanh'): ?>
                        <span class="badge bg-primary">Đã hoàn thành</span>
                        <?php elseif ($booking['status'] == 'da_huy'): ?>
                        <span class="badge bg-danger">Đã hủy</span>
                        <?php endif; ?>
                    </p>

                    <p><strong>Ghi chú:</strong> <?= $booking['report'] ?: '—' ?></p>
                </div>
            </div> <br>

            <div class="card mb-4">
                <div class="card-header fw-bold">Hướng Dẫn Viên Phụ Trách</div>
                <div class="card-body">
                    <?php if ($guide): ?>
                    <p><strong>Họ tên:</strong> <?= $guide['guide_name'] ?></p>
                    <p><strong>Email:</strong> <?= $guide['email'] ?></p>
                    <p><strong>SĐT:</strong> <?= $guide['phone'] ?></p>
                    <p><strong>Chuyên môn:</strong> <?= $guide['specialization'] ?></p>
                    <p><strong>Kinh nghiệm:</strong> <?= $guide['experience_years'] ?> năm</p>
                    <?php else: ?>
                    <p class="text-danger">Chưa phân hướng dẫn viên cho tour này.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <div class="right-column">
            <!-- THÔNG TIN KHÁCH SẠN -->
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông Tin Khách Sạn</div>
                <div class="card-body">
                    <p><strong>Tên khách sạn:</strong> <?= $booking['hotel_name'] ?></p>
                    <p><strong>Chủ khách sạn:</strong> <?= $booking['hotel_manager'] ?></p>
                    <p><strong>SĐT Chủ KS:</strong> <?= $booking['hotel_manager_phone'] ?></p>
                </div>
            </div> <br>
            <!-- THÔNG TIN PHƯƠNG TIỆN -->
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông Tin Phương Tiện</div>
                <div class="card-body">
                    <p><strong>Tên xe:</strong> <?= $vehicle['service_name'] ?></p>
                    <p><strong>Tài xế:</strong> <?= $vehicle['driver_name'] ?></p>
                    <p><strong>SĐT tài xế:</strong> <?= $vehicle['driver_phone'] ?></p>
                    <p><strong>Biển số:</strong> <?= $vehicle['license_plate'] ?></p>
                    <p><strong>Số chỗ:</strong> <?= $vehicle['seat'] ?> chỗ</p>
                    <p><strong>Giá/ngày:</strong> <?= number_format($vehicle['price_per_day']) ?> VND</p>
                </div>
            </div>
        </div>
    </div> <br>

    <div class="card mb-4">
        <div class="card-header fw-bold">Lịch Trình Tour</div>
        <div class="card-body">

            <?php if (!empty($tour_schedules)): ?>
            <div class="schedule-wrapper">
                <?php foreach ($tour_schedules as $schedule): ?>
                <div class="schedule-item">
                    <div class="schedule-day">
                        <span>Ngày <?= $schedule['day_number'] ?></span>
                    </div>

                    <div class="schedule-line"></div>

                    <div class="schedule-content">
                        <p class="schedule-title"><?= $schedule['title'] ?></p>
                        <p class="schedule-desc"><?= $schedule['description'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p class="text-muted">Tour này chưa có lịch trình.</p>
            <?php endif; ?>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Danh Sách Khách</div>
        <div class="card-body">

            <button class="btn btn-addCustomer"
                onclick="document.getElementById('addCustomerForm').style.display='block'">
                + Thêm khách
            </button>

            <?php if (count($customers) > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Điểm danh</th>
                            <th>Ghi chú</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $c): ?>
                            <tr>
                                <td><?= $c['customer_id'] ?></td>
                                <td><?= $c['full_name'] ?></td>
                                <td><?= $c['email'] ?></td>
                                <td><?= $c['phone'] ?></td>
                                <?php foreach ($attendance as $a):
                                    if ($a['customer_id'] == $c['customer_id']) {
                                        ?>
                                        <td>
                                            <?php if ($a['status'] == 'present'): ?>
                                                <span class="badge bg-success">Có mặt</span>
                                            <?php elseif ($a['status'] == 'absent'): ?>
                                                <span class="badge bg-danger">Vắng</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $a['note'] ?></td>
                                    <?php }endforeach; ?>
                                <td class="action-col">
                                    <a href="?action=admin-deleteCustomerBooking&id=<?= $c['bc_id'] ?>&booking_id=<?= $booking['booking_id'] ?>"
                                        class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa khách này?')">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if (!empty($_SESSION['message'])): ?>
                    <div class="alert alert-success fade-alert"><?= $_SESSION['message']; ?></div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <p class=" fw-bold mt-3">Tổng số khách: <?= count($customers) ?> người</p>

            <?php else: ?>
                <p class="text-muted">Chưa thêm khách nào cho booking này.</p>
            <?php endif; ?>

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
            <div class="alert alert-success fade-alert"><?= $_SESSION['message']; ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger fade-alert"><?= $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </div>

</div>