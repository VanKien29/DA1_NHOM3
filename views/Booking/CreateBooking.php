<div class="booking-wrapper">
    <div class="header">
        <h2 class="title">Tạo Booking Mới</h2>
        <div class="subtitle">1. Tour &amp; HDV &nbsp; → &nbsp; 2. Khách &nbsp; → &nbsp; 3. Dịch vụ</div>
    </div>

    <form method="POST" class="booking-grid">
        <input type="hidden" name="current_step" value="<?= $current_step ?>">

        <?php if (!empty($err)): ?>
        <div style="color:red; grid-column:span 2;">
            <?= reset($err) ?>
        </div>
        <?php endif; ?>

        <!-- ==========================
             STEP 1: TOUR & HDV
        ============================ -->
        <?php if ($current_step == 1): ?>
        <div class="card card-full">
            <h4>Thông Tin Tour &amp; Hướng Dẫn Viên</h4>

            <div class="form-group">
                <label>Chọn Tour</label>
                <select name="tour_id" class="form-select">
                    <option value="">-- Chọn tour --</option>
                    <?php foreach ($tours as $t): ?>
                    <option value="<?= $t['tour_id'] ?>"
                        <?= ($_POST['tour_id'] ?? '') == $t['tour_id'] ? 'selected' : '' ?>>
                        <?= $t['tour_name'] ?>
                        <?php if (!empty($t['days'])): ?>
                        (<?= $t['days'] ?> ngày)
                        <?php endif; ?>
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
                        <?= ($_POST['guide_id'] ?? '') == $g['guide_id'] ? 'selected' : '' ?>>
                        <?= $g['name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="date-group">
                <div class="form-group">
                    <label>Ngày đi</label>
                    <input type="date" name="start_date" class="form-control"
                        value="<?= htmlspecialchars($_POST['start_date'] ?? '') ?>">
                    <span class="hint-text">Ngày bắt đầu tour</span>
                </div>
            </div>

            <button type="submit" name="next_1" value="1" class="btn-submit">Tiếp tục</button>
        </div>
        <?php endif; ?>


        <!-- STEP 2: KHÁCH -->
        <?php if ($current_step == 2): ?>
        <div class="card card-full">
            <h4>Danh Sách Khách</h4>

            <!-- giữ dữ liệu step 1 -->
            <input type="hidden" name="tour_id" value="<?= htmlspecialchars($_POST['tour_id']) ?>">
            <input type="hidden" name="guide_id" value="<?= htmlspecialchars($_POST['guide_id']) ?>">
            <input type="hidden" name="start_date" value="<?= htmlspecialchars($_POST['start_date']) ?>">
            <input type="hidden" name="end_date" value="<?= htmlspecialchars($_POST['end_date']) ?>">
            <?php 
                if (!empty($_POST['customers'])) {
                    foreach ($_POST['customers'] as $cid) {
                        echo '<input type="hidden" name="customers[]" value="' . $cid . '">';
                    }
                }
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
                    <?php 
                        $old_customers = $_POST['customers'] ?? [];
                        foreach ($customers as $c): 
                            $blocked = in_array($c['customer_id'], $blocked_customers);
                    ?>
                    <label class="customer-item <?= $blocked ? 'disabled' : '' ?>">
                        <?php if (!$blocked): ?>
                        <input type="checkbox" name="customers[]" value="<?= $c['customer_id'] ?>"
                            <?= in_array($c['customer_id'], $old_customers) ? 'checked' : '' ?>>
                        <?php else: ?>
                        <div class="checkbox-placeholder"></div>
                        <?php endif; ?>

                        <div class="cust-info">
                            <span class="name"><?= $c['full_name'] ?></span>
                            <span class="sub">
                                <?= $c['phone'] ?> · <?= $c['email'] ?? '' ?>
                            </span>
                            <?php if ($blocked): ?>
                            <span class="tag-conflict">Trùng lịch</span>
                            <?php endif; ?>
                        </div>
                    </label>
                    <?php endforeach; ?>
                </div>
                <span class="hint-text">Cần chọn ít nhất 3 khách. Khách “Trùng lịch” sẽ không được chọn.</span>
            </div>

            <div style="display:flex; justify-content:space-between; gap:10px; margin-top:8px;">
                <button type="submit" name="prev_step" value="1" class="btn-prev">← Quay lại</button>
                <button type="submit" name="next_2" value="1" class="btn-submit">Tiếp tục</button>
            </div>
        </div>
        <?php endif; ?>


        <!-- STEP 3: DỊCH VỤ -->
        <?php if ($current_step == 3): ?>
        <div class="card card-full">
            <h4>Dịch Vụ</h4>

            <!-- giữ dữ liệu step trước -->
            <input type="hidden" name="tour_id" value="<?= htmlspecialchars($_POST['tour_id']) ?>">
            <input type="hidden" name="guide_id" value="<?= htmlspecialchars($_POST['guide_id']) ?>">
            <input type="hidden" name="start_date" value="<?= htmlspecialchars($_POST['start_date']) ?>">
            <input type="hidden" name="end_date" value="<?= htmlspecialchars($_POST['end_date']) ?>">

            <?php foreach (($_POST['customers'] ?? []) as $cid): ?>
            <input type="hidden" name="customers[]" value="<?= htmlspecialchars($cid) ?>">
            <?php endforeach; ?>

            <input type="hidden" name="main_customer" value="<?= htmlspecialchars($_POST['main_customer'] ?? '') ?>">

            <div class="form-group">
                <label>Khách sạn</label>
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
                <label>Phương tiện</label>
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

            <div class="form-group">
                <label>Chọn khách đại diện</label>
                <select name="main_customer" class="form-select">
                    <option value="">-- Chọn người đại diện --</option>
                    <?php
                        $selected_customers = $_POST['customers'] ?? [];
                        $main_old = $_POST['main_customer'] ?? '';
                        foreach ($customers as $c):
                            if (!in_array($c['customer_id'], $selected_customers)) continue;
                    ?>
                    <option value="<?= $c['customer_id'] ?>" <?= $main_old == $c['customer_id'] ? 'selected' : '' ?>>
                        <?= $c['full_name'] ?> (<?= $c['phone'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div style="display:flex; justify-content:space-between; gap:10px; margin-top:8px;">
                <button type="submit" name="prev_step" value="2" class="btn-prev">← Quay lại</button>
                <button type="submit" name="final_submit" value="1" class="btn-submit">Tạo Booking</button>
            </div>
        </div>
        <?php endif; ?>

    </form>
</div>