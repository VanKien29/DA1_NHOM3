<?php require_once __DIR__ . '/dashBoard/dashBoard.php'; ?>
<div class="admin-list-container">
    <div class="admin-list-title">Danh sách tour du lịch</div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên tour</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php $stt = 1; foreach($tours as $value): ?>
            <tr>
                <td><?= $stt++; ?></td>
                <td><?= $value['tour_id']; ?></td>
                <td><?= htmlspecialchars($value['tour_name']); ?></td>
                <td><?= htmlspecialchars($value['category_name']); ?></td>
                <td><?= number_format($value['price'], 0, ',', '.'); ?>₫</td>
                <td><?= $value['start_date']; ?></td>
                <td><?= $value['end_date']; ?></td>
                <td>
                    <?php if($value['status'] == 'upcoming'): ?>
                    <span class="badge bg-warning text-dark">Sắp diễn ra</span>
                    <?php elseif($value['status'] == 'ongoing'): ?>
                    <span class="badge bg-success">Đang diễn ra</span>
                    <?php else: ?>
                    <span class="badge bg-secondary">Đã kết thúc</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if(!empty($value['image_src'])): ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . $value['image_src']; ?>" width="100px" alt="Ảnh tour">
                    <?php endif; ?>
                </td>
                <td class="desc-cell">
                    <?= mb_strimwidth(strip_tags($value['description']), 0, 80, '...'); ?>
                </td>
                <td class="admin-action">
                    <a class="btn btn-success text-white text-decoration-none"
                        href="?action=admin-updateTours&id=<?= $value['tour_id']; ?>">Sửa</a>
                    <a class="btn btn-danger text-white text-decoration-none"
                        href="?action=admin-deleteTours&id=<?= $value['tour_id']; ?>"
                        onclick="return confirm('Xác nhận xóa tour này?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= 5; $i++): ?>
        <a href="?action=admin-listTours&page=<?= $i; ?>" class="<?= ($i == $page) ? 'active' : ''; ?>"><?= $i; ?></a>
        <?php endfor; ?>
    </div>

    <div class="admin-action">
        <a href="?action=admin-createTours" class="btn-add text-white text-decoration-none"> Thêm Tour Mới</a>
    </div>
</div>

<?php // thêm 4 dòng này ở mỗi file chức năng admin ?>
</section>
</main>
</div>
</body>

</html>