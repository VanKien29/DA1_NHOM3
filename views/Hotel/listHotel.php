<div class="main-content p-4">
    <div class="admin-table-container">

        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Danh Sách Hotel</h4>
            <a href="?action=admin-createHotel" class="btn btn-primary">+ Thêm Hotel</a>
        </div>

        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên Hotel / Dịch vụ</th>
                    <th>Loại Phòng</th>
                    <th>Giá / Đêm</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($hotels)): ?>
                <?php foreach ($hotels as $index => $d): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($d['service_name']); ?></td>
                    <td><?= htmlspecialchars($d['room_type']); ?></td>
                    <td><?= number_format($d['price_per_night'], 0, ',', '.'); ?> đ</td>
                    <td>
                        <a href="?action=admin-updateHotel&id=<?= $d['hotel_service_id']; ?>"
                            class="btn btn-sm btn-outline-success">Sửa</a>

                        <a href="?action=admin-deleteHotel&id=<?= $d['hotel_service_id']; ?>"
                            class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Bạn có chắc muốn xóa hotel này?')">
                            Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Chưa có hotel nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>