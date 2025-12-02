<div class="container mt-4">
    <h3 class="mb-3">Danh Sách Tour</h3>

    <div class="d-flex justify-content-between mb-3">
        <a href="?action=admin-createTours" class="btn btn-primary">+ Thêm Tour</a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Ảnh</th>
                <th>Tên tour</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Số ngày</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; foreach ($tours as $t): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td>
                    <?php if (!empty($t['tour_images'])): ?>
                    <img src="image/TourImages/<?= htmlspecialchars($t['tour_images']) ?>" width="80" height="60"
                        style="object-fit: cover;">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($t['tour_name']) ?></td>
                <td><?= htmlspecialchars($t['category_name']) ?></td>
                <td><?= number_format($t['price']) ?> đ</td>
                <td><?= (int)($t['days'] ?? 0) ?> ngày</td>
                <td><?= htmlspecialchars(mb_substr($t['description'], 0, 60)) ?>...</td>
                <td class="d-flex gap-1">
                    <a href="?action=admin-detailTour&id=<?= $t['tour_id'] ?>" class="btn btn-sm btn-outline-detail">
                        Chi tiết
                    </a>
                    <a href="?action=admin-updateTours&id=<?= $t['tour_id'] ?>" class="btn btn-outline-success btn-sm">
                        Sửa
                    </a>
                    <a onclick="return confirm('Xóa tour này?')"
                        href="?action=admin-deleteTours&id=<?= $t['tour_id'] ?>" class="btn btn-outline-danger btn-sm">
                        Xóa
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>