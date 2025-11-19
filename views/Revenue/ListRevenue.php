<div class="admin-table-container">
    <div class="table-header d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Danh Sách Doanh Thu</h4>
        <a href="?action=admin-createRevenue" class="btn btn-primary">
            + Thêm Doanh Thu
        </a>
    </div>

    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>ID Revenue</th>
                <th>Booking</th>
                <th>Tour</th>
                <th>Khách hàng</th>
                <th>Mã giảm giá</th>
                <th>Giá gốc</th>
                <th>Giảm giá</th>
                <th>Thành tiền</th>
                <th>Ngày thanh toán</th>
                <th>Phương thức</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php $stt = 1;
            foreach ($revenues as $rev): ?>
                <tr>
                    <td><?= $stt++; ?></td>
                    <td><?= $rev['revenue_id']; ?></td>

                    <!-- có thể đổi sang booking_code, tour_name, customer_name, discount_code nếu bạn JOIN -->
                    <td><?= htmlspecialchars($rev['booking_id']); ?></td>
                    <td><?= htmlspecialchars($rev['tour_id']); ?></td>
                    <td><?= htmlspecialchars($rev['customer_id']); ?></td>
                    <td><?= htmlspecialchars($rev['discount_id']); ?></td>

                    <td><?= number_format($rev['original_price'], 0, ',', '.'); ?>₫</td>
                    <td><?= number_format($rev['discount_amount'], 0, ',', '.'); ?>₫</td>
                    <td><?= number_format($rev['final_price'], 0, ',', '.'); ?>₫</td>

                    <td><?= htmlspecialchars($rev['payment_date']); ?></td>
                    <td><?= htmlspecialchars($rev['payment_method']); ?></td>

                    <td>
                        <a href="?action=admin-updateRevenue&id=<?= $rev['revenue_id'] ?>"
                            class="btn btn-outline-success btn-sm">Sửa</a>

                        <a href="?action=admin-deleteRevenue&id=<?= $rev['revenue_id'] ?>"
                            class="btn btn-outline-danger btn-sm" onclick="return confirm('Xóa bản ghi doanh thu này?')">
                            Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>