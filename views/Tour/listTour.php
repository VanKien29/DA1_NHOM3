<div class="container mt-4">
    <div class="header-wrapper">
        <h4 class="title">Danh Sách Tour</h4>
        <a href="?action=admin-createTours" class="btn btn-add">
            + Thêm Tour
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Ảnh</th>
                <th>Tên tour</th>
                <th>Danh mục</th>
                <th>Giá người lớn</th>
                <th>Giá trẻ em</th>
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
                <td><?= number_format($t['price_adult']) ?> đ</td>
                <td><?= number_format($t['price_child'] ?? 0) ?> đ</td>
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