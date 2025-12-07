<div class="main-content p-4">
    <div class="admin-table-container">
        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Danh Sách Phương Tiện</h4>
            <a href="?action=admin-createVehicles" class="btn btn-primary">+ Thêm Phương Tiện</a>
        </div>
        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th width="60">#</th>
                    <th>Tên Dịch Vụ / Xe</th>
                    <th>Tên tài xế</th>
                    <th>Số điện thoại</th>
                    <th>Biển số xe</th>
                    <th>Số Chỗ</th>
                    <th>Giá / Ngày</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($vehicles)): ?>
                <?php foreach ($vehicles as $index => $d): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($d['service_name']); ?></td>
                    <td><?= htmlspecialchars($d['driver_name']); ?></td>
                    <td><?= htmlspecialchars($d['driver_phone']); ?></td>
                    <td><?= htmlspecialchars($d['license_plate']); ?></td>
                    <td><?= htmlspecialchars($d['seat']); ?></td>
                    <td><?= number_format($d['price_per_day'], 0, ',', '.'); ?> đ</td>
                    <td>
                        <a href="?action=admin-updateVehicles&id=<?= $d['vehicle_service_id']; ?>"
                            class="btn btn-sm btn-outline-success px-3">
                            Sửa
                        </a>
                        <a href="?action=admin-deleteVehicles&id=<?= $d['vehicle_service_id']; ?>"
                            class="btn btn-sm btn-outline-danger px-3"
                            onclick="return confirm('Bạn có chắc muốn xóa xe này?')">
                            Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Chưa có phương tiện nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>