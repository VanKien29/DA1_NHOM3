<div class="admin-table-container">
    <div class="table-header d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Danh sách Tour</h4>
        <a href="?action=admin-createTours" class="btn btn-primary">
            Thêm Tour
        </a>
    </div>

    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tên tour</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Bắt đầu</th>
                <th>Kết thúc</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tours as $tour): ?>
            <tr>
                <td><?= $tour['tour_id'] ?></td>
                <td><?= htmlspecialchars($tour['tour_name']) ?></td>
                <td><?= htmlspecialchars($tour['category_name']) ?></td>
                <td><?= number_format($tour['price'], 0, ',', '.') ?>₫</td>
                <td><?= $tour['start_date'] ?></td>
                <td><?= $tour['end_date'] ?></td>
                <td>
                    <?php if ($tour['status'] == 'upcoming'): ?>
                    <span class="badge bg-warning">Sắp diễn ra</span>
                    <?php elseif ($tour['status'] == 'ongoing'): ?>
                    <span class="badge bg-success">Đang diễn ra</span>
                    <?php else: ?>
                    <span class="badge bg-secondary">Đã kết thúc</span>
                    <?php endif; ?>
                </td>
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