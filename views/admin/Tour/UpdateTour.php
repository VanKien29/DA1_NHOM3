<?php
// thêm require_once ở đầu mỗi file chức năng admin
require_once __DIR__ . '/../dashBoard/dashBoard.php';
?>
<div class="admin-list-container">
    <div class="admin-list-title">Cập nhật Tour</div>

    <form method="POST" action="">
        <div class="form-group">
            <label for="tour_name">Tên Tour</label>
            <input type="text" id="tour_name" name="tour_name" class="form-control"
                value="<?= htmlspecialchars($tour['tour_name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="category_id">Danh mục</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <?php foreach($categories as $cate): ?>
                    <option value="<?= $cate['category_id']; ?>"
                        <?= ($tour['category_id'] == $cate['category_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($cate['category_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Giá Tour (₫)</label>
            <input type="number" id="price" name="price" class="form-control"
                value="<?= $tour['price']; ?>" required>
        </div>

        <div class="form-group-inline">
            <div>
                <label for="start_date">Ngày bắt đầu</label>
                <input type="date" id="start_date" name="start_date" class="form-control"
                    value="<?= $tour['start_date']; ?>" required>
            </div>
            <div>
                <label for="end_date">Ngày kết thúc</label>
                <input type="date" id="end_date" name="end_date" class="form-control"
                    value="<?= $tour['end_date']; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="upcoming" <?= ($tour['status']=='upcoming')?'selected':''; ?>>Sắp diễn ra</option>
                <option value="ongoing" <?= ($tour['status']=='ongoing')?'selected':''; ?>>Đang diễn ra</option>
                <option value="finished" <?= ($tour['status']=='finished')?'selected':''; ?>>Đã kết thúc</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea id="description" name="description" class="form-control"
                rows="4"><?= htmlspecialchars($tour['description']); ?></textarea>
        </div>

        <div class="form-action">
            <button type="submit" class="btn-add text-white text-decoration-none">Cập nhật Tour</button>
            <a href="?action=admin-listTours" class="btn btn-secondary text-decoration-none">Quay lại</a>
        </div>
    </form>
</div>

<?php // thêm 5 dòng này ở mỗi file chức năng admin ?>
</section>
</main>
</div>
</body>
</html>
