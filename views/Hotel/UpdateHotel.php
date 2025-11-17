<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Hotel</h4>

        <form method="POST">
            <?php if (!empty($err['empty'])): ?>
            <div class="text-danger err"><?= $err['empty']; ?></div>
            <?php endif; ?>

            <!-- Tên dịch vụ / hotel -->
            <div class="form-group mb-3">
                <label>Tên Hotel / Dịch vụ</label>
                <input type="text" name="service_name" class="form-control"
                    value="<?= htmlspecialchars($hotel['service_name'] ?? '') ?>">
                <?php if (!empty($err['service_name'])): ?>
                <div class="text-danger err"><?= $err['service_name']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Loại phòng -->
            <div class="form-group mb-3">
                <label>Loại Phòng</label>
                <input type="text" name="room_type" class="form-control"
                    value="<?= htmlspecialchars($hotel['room_type'] ?? '') ?>">
                <?php if (!empty($err['room_type'])): ?>
                <div class="text-danger err"><?= $err['room_type']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Giá mỗi đêm -->
            <div class="form-group mb-3">
                <label>Giá Mỗi Đêm</label>
                <input type="number" step="0.01" name="price_per_night" class="form-control"
                    value="<?= htmlspecialchars($hotel['price_per_night'] ?? '') ?>">
                <?php if (!empty($err['price_per_night'])): ?>
                <div class="text-danger err"><?= $err['price_per_night']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Mô tả -->
            <div class="form-group mb-3">
                <label>Mô Tả</label>
                <textarea name="description" class="form-control"
                    rows="3"><?= htmlspecialchars($hotel['description'] ?? '') ?></textarea>
                <?php if (!empty($err['description'])): ?>
                <div class="text-danger err"><?= $err['description']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                <a href="?action=admin-listHotel" class="btn btn-secondary ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>