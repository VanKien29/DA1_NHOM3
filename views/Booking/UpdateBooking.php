<div class="booking-wrapper">
    <div class="header">
        <h2 class="title">Cập Nhật Booking #<?= $booking['booking_id'] ?></h2>
        <div class="subtitle">
            1. Tour &amp; HDV &nbsp; → &nbsp; 2. Khách &nbsp; → &nbsp; 3. Dịch vụ
        </div>
    </div>

    <form method="POST" class="booking-grid">
        <input type="hidden" name="current_step" value="<?= $current_step ?>">
        <?php if (!empty($err)): ?>
        <div class="error-box" style="color:red; grid-column:span 2;">
            <?= reset($err) ?>
        </div>
        <?php endif; ?>

        <!-- STEP 1: TOUR & HDV -->
        <?php if ($current_step == 1): ?>
        <div class="card card-full">
            <h4>Thông Tin Tour &amp; Hướng Dẫn Viên</h4>

            <div class="form-group">
                <label>Chọn Tour</label>
                <select name="tour_id" class="form-select">
                    <option value="">-- Chọn tour --</option>
                    <?php 
                        $tour_selected = $_POST['tour_id'] ?? $booking['tour_id'];
                        foreach ($tours as $t): 
                    ?>
                    <option value="<?= $t['tour_id'] ?>" <?= $tour_selected == $t['tour_id'] ? 'selected' : '' ?>>
                        <?= $t['tour_name'] ?> (<?= $t['days'] ?> ngày)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Hướng Dẫn Viên</label>
                <select name="guide_id" class="form-select">
                    <option value="">-- Chọn HDV --</option>
                    <?php 
                        $guide_selected = $_POST['guide_id'] ?? $booking['guide_id'];
                        foreach ($guides as $g): 
                    ?>
                    <option value="<?= $g['guide_id'] ?>" <?= $guide_selected == $g['guide_id'] ? 'selected' : '' ?>>
                        <?= $g['name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Ngày đi</label>
                <input type="date" name="start_date" class="form-control"
                    value="<?= htmlspecialchars($_POST['start_date'] ?? $booking['start_date']) ?>">
                <span class="hint-text">Ngày bắt đầu tour</span>
            </div>

            <div class="action-row" style="display:flex; justify-content:space-between; gap:10px; margin-top:8px;">
                <a href="?action=admin-listBooking" class="btn-prev">Quay lại</a>
                <button type="submit" name="next_1" value="1" class="btn-submit">Tiếp tục</button>
            </div>
        </div>
        <?php endif; ?>

        <!-- STEP 2: KHÁCH -->
        <?php if ($current_step == 2): ?>
        <div class="card card-full">
            <h4>Danh Sách Khách</h4>

            <!-- Giữ dữ liệu step 1 -->
            <input type="hidden" name="tour_id" value="<?= htmlspecialchars($_POST['tour_id']) ?>">
            <input type="hidden" name="guide_id" value="<?= htmlspecialchars($_POST['guide_id']) ?>">
            <input type="hidden" name="start_date" value="<?= htmlspecialchars($_POST['start_date']) ?>">
            <input type="hidden" name="end_date"
                value="<?= htmlspecialchars($_POST['end_date'] ?? $booking['end_date']) ?>">

            <?php
                if (!empty($_POST['customers'])) {
                    foreach ($_POST['customers'] as $cid) {
                        echo '<input type="hidden" name="customers[]" value="' . (int)$cid . '">';
                    }
                }
                $selected_customers = $_POST['customers'] ?? $selected_old;
            ?>

            <div class="form-group">
                <label>Tìm kiếm khách</label>
                <div class="search-row">
                    <input type="text" name="search_customer"
                        value="<?= htmlspecialchars($_POST['search_customer'] ?? '') ?>"
                        class="form-control search-input" placeholder="Nhập tên hoặc số điện thoại...">
                    <button type="submit" name="search_btn" value="1" class="btn-search">
                        Tìm kiếm
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label>Chọn khách tham gia</label>
                <div class="customer-list">
                    <?php foreach ($customers as $c): 
                        $cid = $c['customer_id'];
                        $blocked = in_array($cid, $blocked_customers);
                    ?>
                    <label class="customer-item <?= $blocked ? 'disabled' : '' ?>">
                        <?php if (!$blocked): ?>
                        <input type="checkbox" name="customers[]" value="<?= $cid ?>"
                            <?= in_array($cid, $selected_customers) ? 'checked' : '' ?>>
                        <?php else: ?>
                        <div class="checkbox-placeholder"></div>
                        <?php endif; ?>

                        <div class="cust-info">
                            <span class="name"><?= $c['full_name'] ?></span>
                            <span class="sub"><?= $c['phone'] ?> · <?= $c['email'] ?></span>
                            <?php if ($blocked): ?>
                            <span class="tag-conflict">Trùng lịch</span>
                            <?php endif; ?>
                        </div>
                    </label>
                    <?php endforeach; ?>
                </div>
                <span class="hint-text">Cần chọn ít nhất 3 khách. Khách trùng lịch sẽ bị khóa.</span>
            </div>
            <div class="action-row" style="display:flex; justify-content:space-between; gap:10px; margin-top:8px;">
                <button type="submit" name="prev_step" value="1" class="btn-prev">Quay lại</button>
                <button type="submit" name="next_2" value="1" class="btn-submit">Tiếp tục</button>
            </div>
        </div>
        <?php endif; ?>

        <!-- STEP 3: DỊCH VỤ & XE -->
        <?php if ($current_step == 3): ?>
        <div class="card card-full">
            <h4>Dịch Vụ &amp; Phương Tiện Theo Lịch Trình</h4>

            <!-- Giữ dữ liệu step 1 & 2 -->
            <input type="hidden" name="tour_id" value="<?= htmlspecialchars($_POST['tour_id']) ?>">
            <input type="hidden" name="guide_id" value="<?= htmlspecialchars($_POST['guide_id']) ?>">
            <input type="hidden" name="start_date" value="<?= htmlspecialchars($_POST['start_date']) ?>">
            <input type="hidden" name="end_date" value="<?= htmlspecialchars($_POST['end_date']) ?>">

            <?php foreach ($selected_customers as $cid): ?>
            <input type="hidden" name="customers[]" value="<?= (int)$cid ?>">
            <?php endforeach; ?>

            <!-- KHÁCH SẠN -->
            <div class="form-group">
                <label>Khách sạn</label>
                <select name="hotel_id" class="form-select">
                    <option value="">-- Chọn khách sạn --</option>
                    <?php 
                        $hotel_selected = $_POST['hotel_id'] ?? $booking['hotel_id'];
                        foreach ($hotels as $h): 
                    ?>
                    <option value="<?= $h['hotel_service_id'] ?>"
                        <?= $hotel_selected == $h['hotel_service_id'] ? 'selected' : '' ?>>
                        <?= $h['service_name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- KHÁCH ĐẠI DIỆN -->
            <div class="form-group">
                <label>Khách đại diện</label>
                <select name="main_customer" class="form-select">
                    <option value="">-- Chọn người đại diện --</option>
                    <?php 
                        $main_selected = $_POST['main_customer'] ?? $main_old;
                        foreach ($selected_customers as $cid):
                            $c = $this->CustomerQuery->findCustomer($cid);
                    ?>
                    <option value="<?= $cid ?>" <?= $cid == $main_selected ? 'selected' : '' ?>>
                        <?= $c['full_name'] ?> (<?= $c['phone'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="<?= $booking['status'] ?>" selected>
                        <?= $booking['status'] ?>
                    </option>
                    <?php if ($booking['status'] !== 'da_hoan_thanh'): ?>
                    <option value="da_huy" <?= (($_POST['status'] ?? '') == 'da_huy') ? 'selected' : '' ?>>
                        Hủy booking
                    </option>
                    <?php endif; ?>
                </select>
                <span class="hint-text">
                    Chỉ cho phép đổi sang trạng thái <b>Đã hủy</b>.
                </span>
            </div>

            <!-- LỊCH TRÌNH & XE THEO NGÀY -->
            <?php 
                $selected_customers = $selected_customers ?? [];
            ?>
            <div class="trip-box">
                <?php foreach ($schedules as $sc): 
                    $sid = $sc['tour_schedule_id'];
                    $oldVehicle = $segment_grouped[$sid]['vehicle_id'] ?? "";
                    $oldExcluded = $segment_grouped[$sid]['excluded'] ?? [];
                ?>
                <div class="segment-item">
                    <div class="segment-head">
                        <div>
                            <strong style="color: #2563eb">Ngày <?= $sc['day_number'] ?>:</strong>
                            <span class="segment-title"><?= $sc['title'] ?></span>
                        </div>
                        <button style="color: #2563eb" type="button" onclick="toggleExcludeList(this)">▼ Khách không đi
                            xe</button>
                    </div>

                    <div class="segment-body">
                        <label>Phương tiện</label>
                        <select name="segment_vehicle[<?= $sid ?>]" class="form-select">
                            <option value="">-- Không dùng xe --</option>
                            <?php foreach ($vehicles as $v): ?>
                            <option value="<?= $v['vehicle_service_id'] ?>"
                                <?= ($oldVehicle == $v['vehicle_service_id']) ? 'selected' : '' ?>>
                                <?= $v['service_name'] ?> (<?= $v['seat'] ?> chỗ -
                                <?= number_format($v['price_per_day']) ?>đ)
                            </option>
                            <?php endforeach; ?>
                        </select>

                        <div class="exclude-box hidden">
                            <label>Khách không đi xe</label>
                            <div class="exclude-list">
                                <?php foreach ($selected_customers as $cid): 
                                    $c = $this->CustomerQuery->findCustomer($cid);
                                ?>
                                <label class="exclude-item">
                                    <input type="checkbox" name="segment_exclude[<?= $sid ?>][]"
                                        value="<?= $c['customer_id'] ?>"
                                        <?= in_array($c['customer_id'], $oldExcluded) ? 'checked' : '' ?>>
                                    <?= $c['full_name'] ?>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>


            <div class="submit-area" style="display:flex; justify-content:space-between; gap:10px; margin-top:8px;">
                <button type="submit" name="prev_step" value="2" class="btn-prev">Quay lại</button>
                <button type="submit" name="final_submit" value="1" class="btn-submit">
                    Lưu Cập Nhật
                </button>
            </div>
        </div>
        <?php endif; ?>

    </form>
</div>

<script>
function toggleExcludeList(btn) {
    const box = btn.closest('.segment-item').querySelector('.exclude-box');
    box.classList.toggle('hidden');
}
</script>