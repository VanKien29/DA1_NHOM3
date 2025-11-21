<link rel="stylesheet" href="./views/User/listUsers.css">

<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Hotel</h4>

        <!-- BẮT BUỘC CÓ enctype để upload file -->
        <form method="POST" enctype="multipart/form-data">

            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger err mb-2"><?= $err['empty'] ?></div>
            <?php endif; ?>

            <!-- Tên dịch vụ / Hotel (service_name) -->
            <div class="form-group mb-3">
                <label>Tên Hotel / Dịch vụ</label>
                <input type="text" name="service_name" class="form-control"
                       value="<?= htmlspecialchars($_POST['service_name'] ?? '') ?>">
                <?php if (!empty($err['service_name'])): ?>
                    <div class="text-danger err"><?= $err['service_name'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Loại phòng (room_type) -->
            <div class="form-group mb-3">
                <label>Loại Phòng</label>
                <input type="text" name="room_type" class="form-control"
                       value="<?= htmlspecialchars($_POST['room_type'] ?? '') ?>">
                <?php if (!empty($err['room_type'])): ?>
                    <div class="text-danger err"><?= $err['room_type'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Giá / đêm -->
            <div class="form-group mb-3">
                <label>Giá Mỗi Đêm</label>
                <input type="number" step="0.01" name="price_per_night" class="form-control"
                       value="<?= htmlspecialchars($_POST['price_per_night'] ?? '') ?>">
                <?php if (!empty($err['price_per_night'])): ?>
                    <div class="text-danger err"><?= $err['price_per_night'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Mô tả -->
            <div class="form-group mb-3">
                <label>Mô Tả</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                <?php if (!empty($err['description'])): ?>
                    <div class="text-danger err"><?= $err['description'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Upload ảnh như Guide -->
            <div class="form-group mb-3">
                <label>Ảnh Hotel</label>
                <input type="file" name="hotel_image" class="form-control">
                <?php if (!empty($err['hotel_image'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['hotel_image']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Thêm</button>
                <a href="?action=admin-listHotel" class="btn btn-secondary px-4 ms-2">Quay lại</a>
            </div>

        </form>
    </div>
</div>
