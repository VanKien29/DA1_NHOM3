<link rel="stylesheet" href="./views/Booking/CreateBooking.css">

<?php
$hotel_id = $booking['hotel_id'];
$rooms = $this->bookingQuery->getRoomsByHotel($hotel_id);
$currentRooms = $this->bookingQuery->getRoomIdsByBooking($booking['booking_id']);
?>

<div class="booking-wrapper">
    <div class="header">
        <h2 class="title">Cập Nhật Booking</h2>
    </div>

    <?php if (!empty($err['empty'])): ?>
        <div><?= $err['empty'] ?></div>
    <?php endif; ?>

    <form method="POST" class="booking-grid">

        <!-- TOUR -->
        <div class="card">
            <h4>Thông Tin Tour</h4>

            <div class="form-group">
                <label>Chọn Tour</label>
                <select name="tour_id" class="form-select">
                    <?php foreach ($tours as $t): ?>
                        <option value="<?= $t['tour_id'] ?>" <?= ($booking['tour_id'] == $t['tour_id']) ? 'selected' : '' ?>>
                            <?= $t['tour_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Hướng Dẫn Viên</label>
                <select name="guide_id" class="form-select">
                    <?php foreach ($guides as $g): ?>
                        <option value="<?= $g['guide_id'] ?>" <?= ($booking['guide_id'] == $g['guide_id']) ? 'selected' : '' ?>>
                            <?= $g['name'] ?> (<?= $g['experience_years'] ?> năm)
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($err['guide'])): ?>
                    <div class="error"><?= $err['guide'] ?></div>
                <?php endif; ?>
            </div>

            <div class="date-group">
                <div class="form-group">
                    <label>Ngày đi</label>
                    <input type="date" name="start_date" class="form-control" value="<?= $booking['start_date'] ?>">
                </div>
                <div class="form-group">
                    <label>Ngày về</label>
                    <input type="date" name="end_date" class="form-control" value="<?= $booking['end_date'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Trạng Thái Booking</label>
                <select name="status" class="form-select">
                    <option value="cho_duyet" <?= ($booking['status'] == 'cho_duyet') ? 'selected' : '' ?>>Chờ duyệt</option>
                    <option value="dang_dien_ra" <?= ($booking['status'] == 'dang_dien_ra') ? 'selected' : '' ?>>Đang diễn ra
                    </option>
                    <option value="da_hoan_thanh" <?= ($booking['status'] == 'da_hoan_thanh') ? 'selected' : '' ?>>Đã hoàn
                        thành</option>
                    <option value="da_huy" <?= ($booking['status'] == 'da_huy') ? 'selected' : '' ?>>Đã huỷ</option>
                </select>
            </div>
        </div>

        <!-- DỊCH VỤ -->
        <div class="card">
            <h4>Dịch Vụ</h4>

            <div class="form-group">
                <label>Khách Sạn</label>
                <select name="hotel_id" class="form-select" onchange="this.form.submit()">
                    <?php foreach ($hotels as $h): ?>
                        <option value="<?= $h['hotel_service_id'] ?>" <?= ($booking['hotel_id'] == $h['hotel_service_id']) ? 'selected' : '' ?>>
                            <?= $h['service_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Phương Tiện</label>
                <select name="vehicle_id" class="form-select">
                    <?php foreach ($vehicles as $v): ?>
                        <option value="<?= $v['vehicle_service_id'] ?>"
                            <?= ($booking['vehicle_id'] == $v['vehicle_service_id']) ? 'selected' : '' ?>>
                            <?= $v['service_name'] ?> (<?= $v['seat'] ?> chỗ)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- KHÁCH -->
        <div class="card card-full">
            <h4>Danh Sách Khách</h4>

            <div class="form-group">
                <label>Khách Tham Gia</label>
                <select name="customers[]" multiple class="form-select multi">
                    <?php foreach ($customers as $c): ?>
                        <option value="<?= $c['customer_id'] ?>" <?= in_array($c['customer_id'], $selectedCustomers) ? 'selected' : '' ?>>
                            <?= $c['full_name'] ?> - <?= $c['phone'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($err['customers'])): ?>
                    <div class="error"><?= $err['customers'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Khách Đại Diện</label>
                <select name="main_customer" class="form-select">
                    <option value="">-- Chọn người đại diện --</option>
                    <?php foreach ($customers as $c): ?>
                        <option value="<?= $c['customer_id'] ?>" <?= ($main_customer_old == $c['customer_id']) ? 'selected' : '' ?>>
                            <?= $c['full_name'] ?> - <?= $c['phone'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- PHÒNG -->
        <div class="card card-full">
            <h4>Chọn Phòng Khách Sạn</h4>

            <?php if (!empty($err['rooms'])): ?>
                <div class="error" style="color:red;"><?= $err['rooms'] ?></div>
            <?php endif; ?>

            <div class="rooms-list">
                <?php foreach ($rooms as $r): ?>
                    <label class="room-item">
                        <input type="checkbox" name="room_ids[]" value="<?= $r['room_id'] ?>" <?= in_array($r['room_id'], $currentRooms) ? 'checked' : '' ?>>
                        Phòng <?= $r['room_number'] ?> - Tầng <?= $r['floor'] ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="submit-area">
            <button type="submit" class="btn-submit">Cập Nhật Booking</button>
        </div>

    </form>
</div>