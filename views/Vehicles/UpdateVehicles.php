<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Phương Tiện</h4>

        <form method="POST">

            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger err"><?= $err['empty']; ?></div>
            <?php endif; ?>

            <!-- Plate Number -->
            <div class="form-group mb-3">
                <label>Biển Số Xe</label>
                <input type="text" name="plate_number" class="form-control"
                       value="<?= htmlspecialchars($vehicles['plate_number']); ?>">
                <?php if (!empty($err['plate_number'])): ?>
                    <div class="text-danger err"><?= $err['plate_number']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Supplier ID -->
            <div class="form-group mb-3">
                <label>Nhà Cung Cấp (Supplier ID)</label>
                <input type="number" name="supplier_id" class="form-control"
                       value="<?= htmlspecialchars($vehicles['supplier_id']); ?>">
                <?php if (!empty($err['supplier_id'])): ?>
                    <div class="text-danger err"><?= $err['supplier_id']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Type -->
            <div class="form-group mb-3">
                <label>Loại Xe</label>
                <select name="type" class="form-select">
                    <option value="Bus" <?= ($vehicles['type'] == 'Bus') ? 'selected' : '' ?>>Bus</option>
                    <option value="Car" <?= ($vehicles['type'] == 'Car') ? 'selected' : '' ?>>Car</option>
                </select>
            </div>

            <!-- Capacity -->
            <div class="form-group mb-3">
                <label>Số Chỗ</label>
                <input type="number" name="capacity" class="form-control"
                       value="<?= htmlspecialchars($vehicles['capacity']); ?>">
                <?php if (!empty($err['capacity'])): ?>
                    <div class="text-danger err"><?= $err['capacity']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                <a href="?action=admin-listVehicles" class="btn btn-secondary ms-2 px-4">Quay lại</a>
            </div>

        </form>
    </div>
</div>
