<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Mã Giảm Giá</h4>
        <form method="POST">
            <div class="form-group mb-3">
                <label>Mã giảm giá</label>
                <input type="text" name="code" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Mô tả</label>
                <input type="text" name="description" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Loại</label>
                <select name="discount_type" class="form-select">
                    <option value="percent">Phần trăm (%)</option>
                    <option value="fixed">Số tiền (VNĐ)</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Giá trị</label>
                <input type="number" step="0.01" name="value" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Tour áp dụng</label>
                <select name="tour_id" class="form-select">
                    <?php foreach($tours as $tour): ?>
                    <option value="<?= $tour['tour_id']; ?>"><?= htmlspecialchars($tour['tour_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Ngày bắt đầu</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Ngày kết thúc</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="form-group mb-4">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="active">Đang hoạt động</option>
                    <option value="expired">Hết hạn</option>
                    <option value="upcoming">Sắp tới</option>
                </select>
            </div>
            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Thêm</button>
                <a href="?action=admin-listDiscount" class="btn btn-secondary px-4 ms-2">Quay lại</a>
            </div>
        </form>
    </div>
</div>