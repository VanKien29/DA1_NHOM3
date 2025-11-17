<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Doanh Thu</h4>

        <form method="POST">
            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>

            <!-- BOOKING -->
            <div class="form-group mb-3">
                <label>Booking</label>
                <select name="booking_id" class="form-select">
                    <option value="">-- Chọn Booking --</option>
                    <?php foreach ($bookings as $b): ?>
                        <option value="<?= $b['booking_id']; ?>" <?= (!empty($_POST['booking_id']) && $_POST['booking_id'] == $b['booking_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($b['booking_id']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($err['booking_id'])): ?>
                    <div class="text-danger err"><?= $err['booking_id'] ?></div>
                <?php endif; ?>
            </div>

            <!-- TOUR -->
            <div class="form-group mb-3">
                <label>Tour</label>
                <select name="tour_id" class="form-select">
                    <option value="">-- Chọn Tour --</option>
                    <?php foreach ($tours as $t): ?>
                        <option value="<?= $t['tour_id']; ?>" <?= (!empty($_POST['tour_id']) && $_POST['tour_id'] == $t['tour_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($t['tour_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($err['tour_id'])): ?>
                    <div class="text-danger err"><?= $err['tour_id'] ?></div>
                <?php endif; ?>
            </div>

            <!-- KHÁCH HÀNG -->
            <div class="form-group mb-3">
                <label>Khách hàng</label>
                <select name="customer_id" class="form-select">
                    <option value="">-- Chọn khách hàng --</option>
                    <?php foreach ($customers as $c): ?>
                        <option value="<?= $c['customer_id']; ?>" <?= (!empty($_POST['customer_id']) && $_POST['customer_id'] == $c['customer_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['customer_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($err['customer_id'])): ?>
                    <div class="text-danger err"><?= $err['customer_id'] ?></div>
                <?php endif; ?>
            </div>

            <!-- DISCOUNT -->
            <div class="form-group mb-3">
                <label>Mã giảm giá</label>
                <select name="discount_id" class="form-select">
                    <option value="">-- Không áp dụng --</option>
                    <?php foreach ($discounts as $d): ?>
                        <option value="<?= $d['discount_id']; ?>" <?= (!empty($_POST['discount_id']) && $_POST['discount_id'] == $d['discount_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($d['code']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- GIÁ -->
            <div class="form-group mb-3">
                <label>Giá gốc</label>
                <input type="number" step="0.01" name="original_price" class="form-control"
                    value="<?= htmlspecialchars($_POST['original_price'] ?? '') ?>">
            </div>

            <div class="form-group mb-3">
                <label>Số tiền giảm</label>
                <input type="number" step="0.01" name="discount_amount" class="form-control"
                    value="<?= htmlspecialchars($_POST['discount_amount'] ?? '') ?>">
            </div>

            <div class="form-group mb-3">
                <label>Thành tiền</label>
                <input type="number" step="0.01" name="final_price" class="form-control"
                    value="<?= htmlspecialchars($_POST['final_price'] ?? '') ?>">
            </div>

            <!-- NGÀY THANH TOÁN -->
            <div class="form-group mb-3">
                <label>Ngày thanh toán</label>
                <input type="datetime-local" name="payment_date" class="form-control"
                    value="<?= htmlspecialchars($_POST['payment_date'] ?? '') ?>">
                <?php if (!empty($err['payment_date'])): ?>
                    <div class="text-danger err"><?= $err['payment_date'] ?></div>
                <?php endif; ?>
            </div>

            <!-- PHƯƠNG THỨC -->
            <div class="form-group mb-4">
                <label>Phương thức thanh toán</label>
                <select name="payment_method" class="form-select">
                    <?php $pm = $_POST['payment_method'] ?? 'bank'; ?>
                    <option value="bank" <?= $pm === 'bank' ? 'selected' : '' ?>>Bank</option>
                    <option value="credit" <?= $pm === 'credit' ? 'selected' : '' ?>>Credit</option>
                    <option value="cash" <?= $pm === 'cash' ? 'selected' : '' ?>>Cash</option>
                </select>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Thêm</button>
                <a href="?action=admin-listRevenues" class="btn btn-secondary px-4 ms-2">Quay lại</a>
            </div>
        </form>
    </div>
</div>