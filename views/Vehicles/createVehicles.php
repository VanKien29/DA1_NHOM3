<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Phương Tiện</h4>

        <form method="POST">
            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger err"><?= $err['empty']; ?></div>
            <?php endif; ?>

            <!-- Tên dịch vụ / xe -->
            <div class="form-group mb-3">
                <label>Tên Dịch Vụ / Xe</label>
                <input type="text" name="service_name" class="form-control"
                    value="<?= htmlspecialchars($_POST['service_name'] ?? '') ?>">
                <?php if (!empty($err['service_name'])): ?>
                    <div class="text-danger err"><?= $err['service_name']; ?></div>
                <?php endif; ?>
            </div>
            <!-- Tên tài xế / xe -->
            <div class="form-group mb-3">
                <label>Tên tài xế</label>
                <input type="text" name="driver_name" class="form-control"
                    value="<?= htmlspecialchars($_POST['driver_name'] ?? '') ?>">
                <?php if (!empty($err['driver_name'])): ?>
                    <div class="text-danger err"><?= $err['driver_name']; ?></div>
                <?php endif; ?>
            </div>
            <!-- số điện thoại -->
            <div class="form-group mb-3">
                <label>Số điện thoại</label>
                <input type="text" name="driver_phone" class="form-control"
                    value="<?= htmlspecialchars($_POST['driver_phone'] ?? '') ?>">
                <?php if (!empty($err['driver_phone'])): ?>
                    <div class="text-danger err"><?= $err['driver_phone']; ?></div>
                <?php endif; ?>
            </div>
            <!-- biển số xe -->
            <div class="form-group mb-3">
                <label>Biển số xe</label>
                <input type="text" name="license_plate" class="form-control"
                    value="<?= htmlspecialchars($_POST['license_plate'] ?? '') ?>">
                <?php if (!empty($err['license_plate'])): ?>
                    <div class="text-danger err"><?= $err['license_plate']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Số chỗ ngồi -->
            <div class="form-group mb-3">
                <label>Số Chỗ Ngồi</label>
                <input type="number" name="seat" class="form-control"
                    value="<?= htmlspecialchars($_POST['seat'] ?? '') ?>">
                <?php if (!empty($err['seat'])): ?>
                    <div class="text-danger err"><?= $err['seat']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Giá / ngày -->
            <div class="form-group mb-3">
                <label>Giá Mỗi Ngày</label>
                <input type="number" step="0.01" name="price_per_day" class="form-control"
                    value="<?= htmlspecialchars($_POST['price_per_day'] ?? '') ?>">
                <?php if (!empty($err['price_per_day'])): ?>
                    <div class="text-danger err"><?= $err['price_per_day']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Mô tả -->
            <div class="form-group mb-3">
                <label>Mô Tả</label>
                <textarea name="description" class="form-control"
                    rows="3"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                <?php if (!empty($err['description'])): ?>
                    <div class="text-danger err"><?= $err['description']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Thêm</button>
                <a href="?action=admin-listVehicles" class="btn btn-secondary px-4 ms-2">Quay lại</a>
            </div>
        </form>
    </div>
</div>