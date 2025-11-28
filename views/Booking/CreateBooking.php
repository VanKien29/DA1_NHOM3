<link rel="stylesheet" href="./views/Booking/CreateBooking.css">

<div class="booking-wrapper">
    <div class="header">
        <h2 class="title">Tạo Booking Mới</h2>
    </div>
    <?php if (!empty($err['empty'])): ?>
    <div><?= $err['empty'] ?></div>
    <?php endif; ?>
    <form method="POST" class="booking-grid">
        <div class="card">
            <h4>Thông Tin Tour</h4>
            <div class="form-group">
                <label>Chọn Tour</label>
                <select name="tour_id" class="form-select">
                    <option value="">-- Chọn tour --</option>
                    <?php foreach ($tours as $t): ?>
                    <option value="<?= $t['tour_id'] ?>"
                        <?= (($_POST['tour_id'] ?? '') == $t['tour_id']) ? 'selected' : '' ?>>
                        <?= $t['tour_name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Hướng Dẫn Viên</label>
                <select name="guide_id" class="form-select">
                    <option value="">-- Chọn HDV --</option>
                    <?php foreach ($guides as $g): ?>
                    <option value="<?= $g['guide_id'] ?>"
                        <?= (($_POST['guide_id'] ?? '') == $g['guide_id']) ? 'selected' : '' ?>>
                        <?= $g['guide_id'] ?> - <?= $g['name'] ?> (<?= $g['experience_years'] ?> năm)
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
                    <input type="date" name="start_date" class="form-control"
                        value="<?= htmlspecialchars($_POST['start_date'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Ngày về</label>
                    <input type="date" name="end_date" class="form-control"
                        value="<?= htmlspecialchars($_POST['end_date'] ?? '') ?>">
                </div>
            </div>
        </div>

        <div class="card">
            <h4>Dịch Vụ</h4>

            <div class="form-group">
                <label>Khách Sạn</label>
                <select name="hotel_id" class="form-select">
                    <option value="">-- Chọn khách sạn --</option>
                    <?php foreach ($hotels as $h): ?>
                    <option value="<?= $h['hotel_service_id'] ?>"
                        <?= (($_POST['hotel_id'] ?? '') == $h['hotel_service_id']) ? 'selected' : '' ?>>
                        <?= $h['service_name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Phương Tiện</label>
                <select name="vehicle_id" class="form-select">
                    <option value="">-- Chọn xe --</option>
                    <?php foreach ($vehicles as $v): ?>
                    <option value="<?= $v['vehicle_service_id'] ?>"
                        <?= (($_POST['vehicle_id'] ?? '') == $v['vehicle_service_id']) ? 'selected' : '' ?>>
                        <?= $v['service_name'] ?> (<?= $v['seat'] ?> chỗ)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="card card-full">
            <h4>Danh Sách Khách</h4>

            <div class="form-group">
                <label>Khách Tham Gia</label>
                <select name="customers[]" multiple class="form-select multi">
                    <?php $oldCustomers = $_POST['customers'] ?? []; ?>
                    <?php foreach ($customers as $c): ?>
                    <option value="<?= $c['customer_id'] ?>"
                        <?= in_array($c['customer_id'], $oldCustomers) ? 'selected' : '' ?>>
                        <?= $c['customer_id'] ?> - <?= $c['full_name'] ?> - <?= $c['phone'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($err['customers'])): ?>
                <div class="error"><?= $err['customers'] ?></div>
                <?php endif; ?>
                <?php if (!empty($err['customers_conflict'])): ?>
                <div class="error"><?= $err['customers_conflict'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Khách Đại Diện (Không bắt buộc)</label>
                <select name="main_customer" class="form-select">
                    <option value="">-- Chọn người đại diện --</option>
                    <?php foreach ($customers as $c): ?>
                    <option value="<?= $c['customer_id'] ?>"
                        <?= (($_POST['main_customer'] ?? '') == $c['customer_id']) ? 'selected' : '' ?>>
                        <?= $c['customer_id'] ?> - <?= $c['full_name'] ?> - <?= $c['phone'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($err['main'])): ?>
                <div class="error"><?= $err['main'] ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="submit-area">
            <button type="submit" class="btn-submit">Tạo Booking</button>
        </div>

    </form>
</div>