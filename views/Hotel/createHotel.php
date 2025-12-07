<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Hotel</h4>

        <form method="POST" enctype="multipart/form-data">

            <?php if (!empty($err['empty'])): ?>
            <div class="text-danger err mb-2"><?= $err['empty']; ?></div>
            <?php endif; ?>

            <!-- Tên Hotel -->
            <div class="form-group mb-3">
                <label>Tên Hotel</label>
                <input type="text" name="service_name" class="form-control"
                    value="<?= htmlspecialchars($_POST['service_name'] ?? $hotel['service_name']) ?>">
                <?php if (!empty($err['service_name'])): ?>
                <div class="text-danger err"><?= $err['service_name']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Chủ khách sạn -->
            <div class="form-group mb-3">
                <label>Chủ khách sạn</label>
                <input type="text" name="hotel_manager" class="form-control"
                    value="<?= htmlspecialchars($_POST['hotel_manager'] ?? $hotel['hotel_manager']) ?>">
                <?php if (!empty($err['hotel_manager'])): ?>
                <div class="text-danger err"><?= $err['hotel_manager']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Số điện thoại -->
            <div class="form-group mb-3">
                <label>Số điện thoại</label>
                <input type="text" name="hotel_manager_phone" class="form-control"
                    value="<?= htmlspecialchars($_POST['hotel_manager_phone'] ?? $hotel['hotel_manager_phone']) ?>">
                <?php if (!empty($err['hotel_manager_phone'])): ?>
                <div class="text-danger err"><?= $err['hotel_manager_phone']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Loại phòng -->
            <div class="form-group mb-3">
                <label>Loại Phòng</label>
                <input type="text" name="room_type" class="form-control"
                    value="<?= htmlspecialchars($_POST['room_type'] ?? $hotel['room_type']) ?>">
                <?php if (!empty($err['room_type'])): ?>
                <div class="text-danger err"><?= $err['room_type']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Giá mỗi đêm -->
            <div class="form-group mb-3">
                <label>Giá Mỗi Đêm</label>
                <input type="number" name="price_per_night" class="form-control"
                    value="<?= htmlspecialchars($_POST['price_per_night'] ?? $hotel['price_per_night']) ?>">
                <?php if (!empty($err['price_per_night'])): ?>
                <div class="text-danger err"><?= $err['price_per_night']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Mô tả -->
            <div class="form-group mb-3">
                <label>Mô Tả</label>
                <textarea name="description" class="form-control" rows="3"><?= 
                    htmlspecialchars($_POST['description'] ?? $hotel['description']) 
                ?></textarea>
                <?php if (!empty($err['description'])): ?>
                <div class="text-danger err"><?= $err['description']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Ảnh -->
            <div class="form-group mb-3">
                <label>Ảnh Hotel</label>
                <input type="file" name="hotel_image" class="form-control">

                <?php if (!empty($hotel['hotel_image'])): ?>
                <div class="mt-2">
                    <img src="image/HotelImages/<?= htmlspecialchars($hotel['hotel_image']) ?>" width="140"
                        style="border-radius:8px;object-fit:cover;">
                </div>
                <?php endif; ?>

                <?php if (!empty($err['hotel_image'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['hotel_image']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                <a href="?action=admin-listHotel" class="btn btn-secondary px-4 ms-2">Quay lại</a>
            </div>

        </form>
    </div>
</div>