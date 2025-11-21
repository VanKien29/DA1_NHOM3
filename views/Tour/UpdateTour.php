<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Tour</h4>

        <form method="POST" enctype="multipart/form-data">
            <?php if (!empty($err['empty'])): ?>
            <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
            <div class="text-danger"><?= $success ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label>Tên tour</label>
                <input type="text" name="tour_name" class="form-control"
                    value="<?= htmlspecialchars($tour['tour_name']) ?>">
            </div>

            <div class="mb-3">
                <label>Ảnh tour</label>
                <input type="file" name="tour_images" class="form-control">
                <?php if (!empty($tour['tour_images'])): ?>
                <img src="<?= BASE_ASSETS_UPLOADS . $tour['tour_images'] ?>" width="120" class="mt-2">
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control"
                    rows="3"><?= htmlspecialchars($tour['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Số ngày</label>
                <input type="number" name="duration_days" class="form-control"
                    value="<?= htmlspecialchars($tour['duration_days']) ?>">
                <?php if (!empty($err['duration_days'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['duration_days']) ?></div>
                <?php endif; ?>
                <?php if (!empty($err['duration_time'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['duration_time']) ?>
                </div><?php endif; ?>
            </div>

            <div class="mb-3">
                <label>Số đêm</label>
                <input type="number" name="duration_nights" class="form-control"
                    value="<?= htmlspecialchars($tour['duration_nights']) ?>">
                <?php if (!empty($err['duration_nights'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['duration_nights']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label>Giá</label>
                <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($tour['price']) ?>">

                <?php if (!empty($err['price'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['price']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label>Danh mục</label>
                <select name="category_id" class="form-select" required>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id'] ?>"
                        <?= ($cat['category_id'] == $tour['category_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                <a href="?action=admin-listTours" class="btn btn-secondary ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>