<div class="booking-wrapper">
    <div class="header">
        <h2 class="title">Cập Nhật Booking</h2>
        <div class="subtitle">
            1. Tour & HDV → 2. Khách → 3. Dịch vụ
        </div>
    </div>

    <form method="POST" class="booking-grid">

        <input type="hidden" name="current_step" value="<?= $current_step ?>">

        <?php if (!empty($err)): ?>
        <div class="error-box" style="color: red">
            <?= reset($err) ?>
        </div>
        <?php endif; ?>

        <!-- ===========================================================
             STEP 1 — TOUR & HDV
        ============================================================ -->
        <?php if ($current_step == 1): ?>
        <div class="card card-full">
            <h4>Thông Tin Tour & Hướng Dẫn Viên</h4>

            <div class="form-group">
                <label>Chọn Tour</label>
                <select name="tour_id" class="form-select">
                    <option value="">-- Chọn tour --</option>
                    <?php foreach ($tours as $t): ?>
                    <option value="<?= $t['tour_id'] ?>" <?php 
                            // Lấy từ POST hoặc giá trị cũ
                            $selectedTour = $_POST['tour_id'] ?? $booking['tour_id'];
                            echo ($selectedTour == $t['tour_id']) ? "selected" : "";
                        ?>>
                        <?= $t['tour_name'] ?> (<?= $t['days'] ?> ngày)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Hướng Dẫn Viên</label>
                <select name="guide_id" class="form-select">
                    <option value="">-- Chọn HDV --</option>
                    <?php foreach ($guides as $g): ?>
                    <option value="<?= $g['guide_id'] ?>" <?php
                            $selectedGuide = $_POST['guide_id'] ?? $booking['guide_id'];
                            echo ($selectedGuide == $g['guide_id']) ? "selected" : "";
                        ?>>
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

            <button type="submit" name="next_1" value="1" class="btn-submit">
                Tiếp tục
            </button>
        </div>
        <?php endif; ?>

        <!-- ===========================================================
             STEP 2 — CHỌN KHÁCH
        ============================================================ -->
        <?php if ($current_step == 2): ?>
        <div class="card card-full">
            <h4>Danh Sách Khách</h4>

            <!-- Giữ dữ liệu step 1 -->
            <input type="hidden" name="tour_id" value="<?= htmlspecialchars($_POST['tour_id']) ?>">
            <input type="hidden" name="guide_id" value="<?= htmlspecialchars($_POST['guide_id']) ?>">
            <input type="hidden" name="start_date" value="<?= htmlspecialchars($_POST['start_date']) ?>">
            <input type="hidden" name="end_date" value="<?= htmlspecialchars($_POST['end_date']) ?>">

            <div class="form-group">
                <label>Chọn khách tham gia</label>
                <div class="customer-list">

                    <?php 
                        $checkedList = $_POST['customers'] ?? $selected_old;
                        foreach ($customers as $c):
                            $blocked = in_array($c['customer_id'], $blocked_customers);
                        ?>
                    <label class="customer-item <?= $blocked ? 'disabled' : '' ?>">

                        <?php if (!$blocked): ?>
                        <input type="checkbox" name="customers[]" value="<?= $c['customer_id'] ?>"
                            <?= in_array($c['customer_id'], $checkedList) ? "checked" : "" ?>>
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
                <span class="hint-text">Cần ít nhất 3 khách. Khách trùng lịch sẽ bị khóa.</span>
            </div>

            <div class="form-group">
                <label>Khách đại diện</label>
                <select name="main_customer" class="form-select">
                    <option value="">-- Chọn đại diện --</option>
                    <?php 
                        $main_selected = $_POST['main_customer'] ?? $main_old;
                        foreach ($customers as $c):
                            $blocked = in_array($c['customer_id'], $blocked_customers);
                        ?>
                    <option value="<?= $c['customer_id'] ?>"
                        <?= ($main_selected == $c['customer_id']) ? "selected" : "" ?>
                        <?= $blocked ? "disabled" : "" ?>>
                        <?= $c['full_name'] ?> (<?= $c['phone'] ?>)
                        <?= $blocked ? " - Trùng lịch" : "" ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="action-row">
                <button type="submit" name="prev_step" value="1" class="btn-prev">← Quay lại</button>
                <button type="submit" name="next_2" value="1" class="btn-submit">Tiếp tục</button>
            </div>
        </div>
        <?php endif; ?>

        <!-- ===========================================================
             STEP 3 — DỊCH VỤ
        ============================================================ -->
        <?php if ($current_step == 3): ?>
        <div class="card card-full">
            <h4>Dịch Vụ</h4>

            <!-- Hidden giữ dữ liệu -->
            <input type="hidden" name="tour_id" value="<?= htmlspecialchars($_POST['tour_id']) ?>">
            <input type="hidden" name="guide_id" value="<?= htmlspecialchars($_POST['guide_id']) ?>">
            <input type="hidden" name="start_date" value="<?= htmlspecialchars($_POST['start_date']) ?>">
            <input type="hidden" name="end_date" value="<?= htmlspecialchars($_POST['end_date']) ?>">

            <?php foreach ($_POST['customers'] as $cid): ?>
            <input type="hidden" name="customers[]" value="<?= $cid ?>">
            <?php endforeach; ?>

            <input type="hidden" name="main_customer"
                value="<?= htmlspecialchars($_POST['main_customer'] ?? $main_old) ?>">

            <div class="form-group">
                <label>Khách sạn</label>
                <select name="hotel_id" class="form-select">
                    <option value="">-- Chọn khách sạn --</option>
                    <?php 
                        $old_hotel = $_POST['hotel_id'] ?? $booking['hotel_id'];
                        foreach ($hotels as $h): ?>
                    <option value="<?= $h['hotel_service_id'] ?>"
                        <?= ($old_hotel == $h['hotel_service_id']) ? "selected" : "" ?>>
                        <?= $h['service_name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Phương tiện</label>
                <select name="vehicle_id" class="form-select">
                    <option value="">-- Chọn xe --</option>
                    <?php 
                        $old_vehicle = $_POST['vehicle_id'] ?? $booking['vehicle_id'];
                        foreach ($vehicles as $v): ?>
                    <option value="<?= $v['vehicle_service_id'] ?>"
                        <?= ($old_vehicle == $v['vehicle_service_id']) ? "selected" : "" ?>>
                        <?= $v['service_name'] ?> (<?= $v['seat'] ?> chỗ)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <?php 
                        $old_status = $_POST['status'] ?? $booking['status'];
                    ?>
                    <option value="cho_duyet" <?= $old_status == "cho_duyet" ? "selected" : "" ?>>Chờ duyệt</option>
                    <option value="dang_dien_ra" <?= $old_status == "dang_dien_ra" ? "selected" : "" ?>>Đang diễn ra
                    </option>
                    <option value="da_hoan_thanh" <?= $old_status == "da_hoan_thanh" ? "selected" : "" ?>>
                        Hoàn thành
                    </option>
                </select>
            </div>

            <div class="action-row">
                <button type="submit" name="prev_step" value="2" class="btn-prev">← Quay lại</button>
                <button type="submit" name="final_submit" value="1" class="btn-submit">
                    Lưu Cập Nhật
                </button>
            </div>
        </div>
        <?php endif; ?>

    </form>
</div>