<div class="main-content p-4">
    <div class="admin-table-container">
        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Danh Sách Mã Giảm Giá</h4> <br>
            <a href="?action=admin-createDiscount" class="btn btn-primary">+ Thêm Mã Giảm Giá</a>
        </div>

        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mã</th>
                    <th>Mô tả</th>
                    <th>Loại</th>
                    <th>Giá trị</th>
                    <th>Tour áp dụng</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1; foreach($discounts as $d): ?>
                <tr>
                    <td><?= $stt++; ?></td>
                    <td><?= htmlspecialchars($d['code']); ?></td>
                    <td><?= htmlspecialchars($d['description']); ?></td>
                    <td><?= $d['discount_type'] == 'percent' ? 'Phần trăm' : 'Cố định'; ?></td>
                    <td><?= $d['value']; ?></td>
                    <td><?= htmlspecialchars($d['tour_name']); ?></td>
                    <td><?= $d['start_date'] . ' → ' . $d['end_date']; ?></td>
                    <td><span class="badge bg-info"><?= $d['status']; ?></span></td>
                    <td>
                        <a href="?action=admin-updateDiscount&id=<?= $d['discount_id']; ?>"
                            class="btn btn-sm btn-outline-success">Sửa</a>
                        <a href="?action=admin-deleteDiscount&id=<?= $d['discount_id']; ?>"
                            class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Xóa mã giảm giá này?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>