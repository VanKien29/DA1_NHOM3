<div class="table-header d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Danh sách Tour</h4>

    <div class="action-group d-flex align-items-center gap-3">
        <a href="?action=admin-createTours" class="btn btn-primary">
            Thêm Tour
        </a>
    </div>
</div>

<table class="table table-hover align-middle">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Tên tour</th>
            <th>Ảnh tour</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 1; foreach ($tours as $tour): ?>
        <tr>
            <td><?= $stt++ ?></td>
            <td><?= $tour['tour_id'] ?></td>
            <td><?= htmlspecialchars($tour['tour_name']) ?></td>
            <td>
                <?php if (!empty($tour['tour_images'])): ?>
                <img src="<?= BASE_ASSETS_UPLOADS . $tour['tour_images'] ?>" width="100"
                    alt="<?= htmlspecialchars($tour['tour_name']) ?>">
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($tour['category_name']) ?></td>
            <td><?= number_format($tour['price'], 0, ',', '.') ?>₫</td>
            <td><?= htmlspecialchars($tour['description']) ?></td>
            <td>
                <a href="?action=admin-updateTours&id=<?= $tour['tour_id'] ?>"
                    class="btn btn-outline-success btn-sm">Sửa</a>
                <a href="?action=admin-deleteTours&id=<?= $tour['tour_id'] ?>" class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('Xóa tour này?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>