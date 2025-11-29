<div class="main-content">
    <div class="guide-schedule-wrapper">

        <div class="guide-table-container">

            <div class="guide-table-header d-flex justify-content-between align-items-center">
                <h4>Chi Tiết Tour</h4>
                <a href="?action=guide-schedule" class="btn btn-outline-detail">← Quay lại lịch tour</a>
            </div>

            <!-- THÔNG TIN TOUR -->
            <div class="booking-info-box">
                <h5>Thông tin tour</h5>

                <div class="info-grid">

                    <div>
                        <label>Mã Booking:</label>
                        <span><?= $booking['booking_id'] ?></span>
                    </div>

                    <div>
                        <label>Tour:</label>
                        <span><?= $booking['tour_name'] ?></span>
                    </div>

                    <div>
                        <label>Ngày tạo:</label>
                        <span><?= $booking['created_at'] ?></span>
                    </div>

                    <div>
                        <label>Ngày bắt đầu:</label>
                        <span><?= $booking['start_date'] ?></span>
                    </div>

                    <div>
                        <label>Ngày kết thúc:</label>
                        <span><?= $booking['end_date'] ?></span>
                    </div>

                    <div>
                        <label>Trạng thái:</label>
                        <?php
                        switch ($booking['status']) {
                            case 'dang_dien_ra':
                                echo "<span class='badge bg-success'>Đang diễn ra</span>";
                                break;
                            case 'cho_duyet':
                                echo "<span class='badge bg-warning'>Chờ duyệt</span>";
                                break;
                            case 'da_hoan_thanh':
                                echo "<span class='badge bg-primary'>Đã hoàn thành</span>";
                                break;
                            case 'da_huy':
                                echo "<span class='badge bg-danger'>Đã hủy</span>";
                                break;
                        }
                        ?>
                    </div>

                    <div>
                        <label>Khách sạn:</label>
                        <span><?= $booking['hotel_name'] ?></span>
                    </div>

                    <div>
                        <label>Phương tiện:</label>
                        <span><?= $booking['vehicle_name'] ?></span>
                    </div>

                    <!-- GHI CHÚ TỔNG CỦA TOUR -->
                    <div>
                        <label>Ghi chú:</label>
                        <span><?= !empty($booking['report']) ? $booking['report'] : "Không có ghi chú" ?></span>
                    </div>

                </div>
            </div>

            <!-- HƯỚNG DẪN VIÊN -->
            <div class="booking-info-box">
                <h5>Hướng dẫn viên phụ trách</h5>

                <div class="info-grid">
                    <div>
                        <label>Tên:</label>
                        <span><?= $guide['guide_name'] ?></span>
                    </div>

                    <div>
                        <label>Email:</label>
                        <span><?= $guide['email'] ?></span>
                    </div>

                    <div>
                        <label>SĐT:</label>
                        <span><?= $guide['phone'] ?></span>
                    </div>
                </div>
            </div>

            <!-- DANH SÁCH KHÁCH -->
            <div class="booking-info-box">
                <h5>Danh sách khách</h5>

                <table class="table-schedule">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên khách</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Điểm danh</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;

                        // Map attendance theo customer_id
                        $attMap = [];
                        foreach ($attendance as $a) {
                            $attMap[$a['customer_id']] = $a;
                        }

                        foreach ($customers as $c):
                            $att = $attMap[$c['customer_id']] ?? null;
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>

                                <td>
                                    <?= $c['full_name'] ?>

                                    <?php if ($c['is_main']): ?>
                                        <span class="badge bg-primary" style="margin-left:6px;">Chính</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= $c['phone'] ?></td>
                                <td><?= $c['email'] ?></td>

                                <!-- NÚT ĐIỂM DANH CŨ -->
                                <td>
                                    <form method="POST" action="?action=guide-updateAttendance"
                                        style="display:flex; gap:6px;">
                                        <input type="hidden" name="attendance_id" value="<?= $att['id'] ?>">
                                        <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">

                                        <button name="status" value="present"
                                            class="<?= $att['status'] == 'present' ? 'btn-success' : 'btn-outline-success' ?>">
                                            Có mặt
                                        </button>

                                        <button name="status" value="absent"
                                            class="<?= $att['status'] == 'absent' ? 'btn-danger' : 'btn-outline-danger' ?>">
                                            Vắng
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>

            <!-- THÔNG TIN XE -->
            <div class="booking-info-box">
                <h5>Thông tin phương tiện</h5>

                <div class="info-grid">

                    <div>
                        <label>Tên xe:</label>
                        <span><?= $vehicle['service_name'] ?></span>
                    </div>

                    <div>
                        <label>Số chỗ:</label>
                        <span><?= $vehicle['seat'] ?> chỗ</span>
                    </div>

                    <div>
                        <label>Giá/ngày:</label>
                        <span><?= number_format($vehicle['price_per_day']) ?> đ</span>
                    </div>

                    <div>
                        <label>Mô tả:</label>
                        <span><?= $vehicle['description'] ?></span>
                    </div>

                </div>
            </div>

            <!-- DANH SÁCH PHÒNG KHÁCH SẠN -->
            <div class="booking-info-box">
                <h5>Danh sách phòng khách sạn</h5>

                <?php if (!empty($rooms)): ?>

                    <div class="room-grid"
                        style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:20px;">

                        <?php foreach ($rooms as $room): ?>
                            <div class="room-card" style="background:#fff; padding:16px; border-radius:12px; border:1px solid #e5e7eb; 
                           box-shadow:0 2px 6px rgba(0,0,0,0.05);">
                                <h4 style="margin:10px 0 6px; font-size:18px;"><?= $room['room_name'] ?></h4>
                                <p style="margin:4px 0;">
                                    <strong>Loại phòng:</strong> <?= $room['room_type'] ?>
                                </p>
                                <p style="margin:4px 0;">
                                    <strong>Giường:</strong> <?= $room['bed_type'] ?>
                                </p>
                                <p style="margin:4px 0;">
                                    <strong>Sức chứa:</strong> <?= $room['capacity'] ?> người
                                </p>
                                <p style="margin:4px 0;">
                                    <strong>Giá:</strong>
                                    <?= number_format($room['price_per_night']) ?> đ/đêm
                                </p>
                                <p style="margin-top:8px; color:#555;">
                                    <strong>Mô tả:</strong><br>
                                    <?= !empty($room['description']) ? $room['description'] : "Không có mô tả" ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p style="color:#888;">Khách sạn này chưa có dữ liệu phòng.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>