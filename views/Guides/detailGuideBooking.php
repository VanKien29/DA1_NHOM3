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
                                        class="<?= $att['status']=='present' ? 'btn-success' : 'btn-outline-success' ?>">
                                        Có mặt
                                    </button>

                                    <button name="status" value="absent"
                                        class="<?= $att['status']=='absent' ? 'btn-danger' : 'btn-outline-danger' ?>">
                                        Vắng
                                    </button>
                                </form>
                            </td>

                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>