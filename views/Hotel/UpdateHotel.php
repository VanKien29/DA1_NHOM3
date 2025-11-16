<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Hotel</h4>

        <form method="POST">

            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger err"><?= $err['empty']; ?></div>
            <?php endif; ?>

            <div class="form-group mb-3">
                <label>Tên Hotel</label>
                <input type="text" name="hotel_name" class="form-control"
                       value="<?= htmlspecialchars($hotel['hotel_name']); ?>">
                <?php if (!empty($err['hotel_name'])): ?>
                    <div class="text-danger err"><?= $err['hotel_name']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group mb-3">
                <label>Khu vực</label>
                <input type="text" name="address" class="form-control"
                       value="<?= htmlspecialchars($hotel['address']); ?>">
            </div>
            <div class="form-group mb-3">
                <label>Đánh giá (0 – 5)</label>
                <input type="number" step="0.1" name="rating" class="form-control"
                       value="<?= htmlspecialchars($hotel['rating']); ?>">
                <?php if (!empty($err['rating'])): ?>
                    <div class="text-danger err"><?= $err['rating']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                <a href="?action=admin-listHotel" class="btn btn-secondary ms-2 px-4">Quay lại</a>
            </div>

        </form>
    </div>
</div>
