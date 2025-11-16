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
                    <th>Tên Hotel</th>
                    <th>Khu Vực</th>
                    <th>Đánh Giá</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1; foreach($hotel as $d): ?>
                <tr>
                    <td><?= $stt++; ?></td>
                    <td><?= htmlspecialchars($d['hotel_name']); ?></td>
                    <td><?= htmlspecialchars($d['address']); ?></td>
                    <td><?= htmlspecialchars($d['rating']); ?></td>
                    <td>
                        <a href="?action=admin-updateHotel&id=<?= $d['hotel_id']; ?>"
                           class="btn btn-sm btn-outline-success">Sửa</a>

                        <a href="?action=admin-deleteHotel&id=<?= $d['hotel_id']; ?>"
                           class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Bạn có chắc muốn xóa hotel này?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
