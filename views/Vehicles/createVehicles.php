<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Phương Tiện</h4>

        <form method="POST">

            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger err"><?= $err['empty']; ?></div>
            <?php endif; ?>

            <div class="form-group mb-3">
                <label>Biển Số Xe</label>
                <input type="text" name="plate_number" class="form-control"
                       value="<?= htmlspecialchars($_POST['plate_number'] ?? '') ?>">
            </div>

            <div class="form-group mb-3">
                <label>Nhà Cung Cấp (Supplier ID)</label>
                <input type="number" name="supplier_id" class="form-control"
                       value="<?= htmlspecialchars($_POST['supplier_id'] ?? '') ?>">
            </div>

            <div class="form-group mb-3">
                <label>Loại Xe</label>
                <select name="type" class="form-select">
                    <option value="Bus">Bus</option>
                    <option value="Car">Car</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Số Chỗ Ngồi</label>
                <input type="number" name="capacity" class="form-control"
                       value="<?= htmlspecialchars($_POST['capacity'] ?? '') ?>">
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Thêm</button>
                <a href="?action=admin-listVehicles" class="btn btn-secondary px-4 ms-2">Quay lại</a>
            </div>

        </form>
    </div>
</div>
