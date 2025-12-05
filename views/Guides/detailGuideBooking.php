<div class="main-content">
    <div class="guide-schedule-wrapper">

        <div class="guide-table-container">

            <div class="guide-table-header d-flex justify-content-between align-items-center">
                <h4>Chi Tiết Tour</h4>
                <a href="?action=guide-schedule" class="btn btn-outline-detail">← Quay lại lịch tour</a>
            </div>

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
                        <label>Ngày bắt đầu:</label>
                        <span><?= $booking['start_date'] ?></span>
                    </div>

                    <div>
                        <label>Ngày kết thúc:</label>
                        <span><?= $booking['end_date'] ?></span>
                    </div>

                    <div>
                        <label>Trạng thái:</label>
                        <span id="statusBadge">
                            <?php
                                switch ($booking['status']) {
                                    case 'dang_dien_ra':
                                        echo "<span class='badge bg-success'>Đang diễn ra</span>";
                                        break;
                                    case 'sap_dien_ra':
                                        echo "<span class='badge bg-warning text-dark'>Sắp diễn ra</span>";
                                        break;
                                    case 'cho_xac_nhan_ket_thuc':
                                        echo "<span class='badge bg-warning text-dark'>Chờ xác nhận kết thúc</span>";
                                        break;
                                    case 'da_hoan_thanh':
                                        echo "<span class='badge bg-primary'>Đã hoàn thành</span>";
                                        break;
                                    case 'da_huy':
                                        echo "<span class='badge bg-danger'>Đã hủy</span>";
                                        break;
                                }
                                ?>
                        </span>
                        <?php if($booking['status'] == "da_hoan_thanh"){?>
                        <?php } else { ?>
                        <button class="btn btn-sm btn-status" onclick="toggleStatusForm()">Cập nhật</button>
                        <?php } ?>
                    </div>

                    <div id="statusForm" class="status-form d-none">
                        <form method="POST" action="?action=guide-updateStatusByGuide">
                            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                            <select name="status" class="form-select mb-2">
                                <option value="dang_dien_ra" <?= $booking['status']=='dang_dien_ra'?'selected':'' ?>>
                                    Xác nhận đang diễn ra
                                </option>
                                <option value="da_hoan_thanh" <?= $booking['status']=='da_hoan_thanh'?'selected':'' ?>>
                                    Xác nhận hoàn thành tour
                                </option>
                            </select>
                            <button class="btn btn-saveStatus">Lưu</button>
                        </form>
                    </div>

                    <div>
                        <label>Khách sạn:</label>
                        <span><?= $booking['hotel_name'] ?></span>
                    </div>
                    <div>
                        <label>Chủ khách sạn:</label>
                        <span><?= $booking['hotel_manager'] ?></span>
                    </div>
                    <div>
                        <label>Số điện thoại:</label>
                        <span><?= $booking['hotel_manager_phone'] ?></span>
                    </div>
                    <div>
                        <label>Phương tiện:</label>
                        <span><?= $booking['vehicle_name'] ?></span>
                    </div>
                    <div>
                        <label>Ghi chú:</label>
                        <span><?= !empty($booking['report']) ? $booking['report'] : "Không có ghi chú" ?></span>
                    </div>
                </div>
            </div>

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
                            <td>
                                <?php 
                                if ($booking['status'] === 'dang_dien_ra'): 
                                ?>
                                <form method="POST" action="?action=guide-updateAttendance"
                                    style="display:flex; gap:6px;">
                                    <input type="hidden" name="attendance_id" value="<?= $att['id'] ?>">
                                    <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                    <button name="status" value="present"
                                        class="<?= $att['status'] === 'present' ? 'btn-success' : 'btn-outline-success' ?>">
                                        Có mặt
                                    </button>
                                    <button name="status" value="absent"
                                        class="<?= $att['status'] === 'absent' ? 'btn-danger' : 'btn-outline-danger' ?>">
                                        Vắng
                                    </button>
                                </form>
                                <?php 
                                else: 
                                    if ($att):
                                        if ($att['status'] === 'present'):
                                            echo '<span class="badge bg-success">Có mặt</span>';
                                        elseif ($att['status'] === 'absent'):
                                            echo '<span class="badge bg-danger">Vắng</span>';
                                        else:
                                            echo '<span class="badge bg-secondary">—</span>';
                                        endif;
                                    else:
                                        echo '<span class="badge bg-secondary">—</span>';
                                    endif;
                                endif;
                                ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>

            <div class="booking-info-box">
                <h5>Thông tin phương tiện</h5>
                <div class="info-grid">
                    <div>
                        <label>Tên xe:</label>
                        <span><?= $vehicle['service_name'] ?></span>
                    </div>
                    <div>
                        <label>Tên tài xế:</label>
                        <span><?= $vehicle['driver_name'] ?></span>
                    </div>
                    <div>
                        <label>Số điện thoại:</label>
                        <span><?= $vehicle['driver_phone'] ?></span>
                    </div>
                    <div>
                        <label>Biển số xe:</label>
                        <span><?= $vehicle['license_plate'] ?></span>
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
        </div>
    </div>
</div>
<script>
function toggleStatusForm() {
    const box = document.getElementById("statusForm");
    box.classList.toggle("d-none");
}
</script>