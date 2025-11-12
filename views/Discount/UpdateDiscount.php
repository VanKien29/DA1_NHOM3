<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Mã Giảm Giá</h4>

        <form method="POST">
            <div class="form-group mb-3">
                <label>Mã giảm giá</label>
                <input type="text" name="code" class="form-control" value="<?= htmlspecialchars($discount['code']); ?>"
                    required>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <input type="text" name="description" class="form-control"
                    value="<?= htmlspecialchars($discount['description']); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Loại</label>
                <select name="discount_type" class="form-select">
                    <option value="percent" <?= ($discount['discount_type'] == 'percent') ? 'selected' : ''; ?>>Phần
                        trăm (%)</option>
                    <option value="fixed" <?= ($discount['discount_type'] == 'fixed') ? 'selected' : ''; ?>>Số tiền
                        (VNĐ)</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Giá trị</label>
                <input type="number" step="0.01" name="value" class="form-control"
                    value="<?= htmlspecialchars($discount['value']); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Tour áp dụng</label>
                <select name="tour_id" class="form-select">
                    <?php foreach($tours as $tour): ?>
                    <option value="<?= $tour['tour_id']; ?>"
                        <?= ($discount['tour_id'] == $tour['tour_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($tour['tour_name']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Ngày bắt đầu</label>
                <input type="date" name="start_date" class="form-control"
                    value="<?= htmlspecialchars($discount['start_date']); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Ngày kết thúc</label>
                <input type="date" name="end_date" class="form-control"
                    value="<?= htmlspecialchars($discount['end_date']); ?>" required>
            </div>

            <div class="form-group mb-4">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="active" <?= ($discount['status'] == 'active') ? 'selected' : ''; ?>>Đang hoạt động
                    </option>
                    <option value="expired" <?= ($discount['status'] == 'expired') ? 'selected' : ''; ?>>Hết hạn
                    </option>
                    <option value="upcoming" <?= ($discount['status'] == 'upcoming') ? 'selected' : ''; ?>>Sắp tới
                    </option>
                </select>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                <a href="?action=admin-listDiscount" class="btn btn-secondary ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>