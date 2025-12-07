<div class="main-content p-4">
    <div class="admin-table-container">
        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Danh Sách khách sạn</h4>
            <a href="?action=admin-createHotel" class="btn btn-primary">+ Thêm khách sạn</a>
        </div>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ảnh đại diện</th>
                    <th>Tên Hotel</th>
                    <th>Chủ khách sạn</th>
                    <th>Số điện thoại</th>
                    <th>Loại Phòng</th>
                    <th>Giá / Đêm</th>
                    <th style="text-align: center;">Hành Động</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($hotels)): ?>
                <?php foreach ($hotels as $index => $d): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td>
                        <?php if (!empty($d['hotel_image'])): ?>
                        <img src="<?= BASE_ASSETS_UPLOADS . $d['hotel_image'] ?>" width="70" height="55"
                            style="object-fit: cover; border-radius: 6px;">
                        <?php else: ?>
                        <span class="text-muted">Không có ảnh</span>
                        <?php endif; ?>
                    </td>
                    <td class="fw-semibold"><?= htmlspecialchars($d['service_name']); ?></td>
                    <td class="fw-semibold"><?= htmlspecialchars($d['hotel_manager']); ?></td>
                    <td class="fw-semibold"><?= htmlspecialchars($d['hotel_manager_phone']); ?></td>
                    <td><?= htmlspecialchars($d['room_type']); ?></td>
                    <td><?= number_format($d['price_per_night'], 0, ',', '.'); ?> đ</td>
                    <td style="text-align: center;">
                        <a href="?action=admin-updateHotel&id=<?= $d['hotel_service_id']; ?>"
                            class="btn btn-sm btn-outline-success">
                            Sửa
                        </a>
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
                    <td colspan="6" class="text-center">Chưa có hotel nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>