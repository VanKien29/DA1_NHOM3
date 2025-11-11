<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Tour</h4>

        <form method="POST">
            <div class="mb-3">
                <label>Tên tour</label>
                <input type="text" name="tour_name" class="form-control"
                    value="<?= htmlspecialchars($tour['tour_name']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="3"
                    required><?= htmlspecialchars($tour['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Giá</label>
                <input type="number" name="price" class="form-control" value="<?= $tour['price'] ?>" required>
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

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Ngày bắt đầu</label>
                    <input type="date" name="start_date" class="form-control" value="<?= $tour['start_date'] ?>"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Ngày kết thúc</label>
                    <input type="date" name="end_date" class="form-control" value="<?= $tour['end_date'] ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="upcoming" <?= ($tour['status'] == 'upcoming') ? 'selected' : '' ?>>Sắp diễn ra
                    </option>
                    <option value="ongoing" <?= ($tour['status'] == 'ongoing') ? 'selected' : '' ?>>Đang diễn ra
                    </option>
                    <option value="finished" <?= ($tour['status'] == 'finished') ? 'selected' : '' ?>>Đã kết thúc
                    </option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                <a href="?action=admin-listTours" class="btn btn-secondary ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>