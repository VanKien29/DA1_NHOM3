<div class="main-content p-4">
    <div class="admin-table-container">

        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Danh Sách Phương Tiện</h4>
            <a href="?action=admin-createVehicles" class="btn btn-primary">+ Thêm Xe</a>
        </div>

        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th width="60">#</th>
                    <th>Biển Số</th>
                    <th>Nhà Cung Cấp (Supplier ID)</th>
                    <th>Loại Xe</th>
                    <th>Số Chỗ</th>
                    <th>Hành Động</th>
                </tr>
            </thead>

            <tbody>
                <?php if(empty($vehicles)): ?>
                    <tr>
                        <td colspan="6" class="text-muted py-3">
                            <i>Không có phương tiện nào trong hệ thống.</i>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $stt = 1; foreach($vehicles as $d): ?>
                        <tr>
                            <td><?= $stt++; ?></td>
                            <td><?= htmlspecialchars($d['plate_number']); ?></td>
                            <td><?= htmlspecialchars($d['supplier_id']); ?></td>
                            <td><?= htmlspecialchars($d['type']); ?></td>
                            <td><?= htmlspecialchars($d['capacity']); ?></td>

                            <td>
                                <a href="?action=admin-updateVehicles&id=<?= $d['vehicle_id']; ?>"
                                   class="btn btn-sm btn-outline-success px-3">Sửa</a>

                                <a href="?action=admin-deleteVehicles&id=<?= $d['vehicle_id']; ?>"
                                   class="btn btn-sm btn-outline-danger px-3"
                                   onclick="return confirm('Bạn có chắc muốn xóa xe này?')">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>
