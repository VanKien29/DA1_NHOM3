<div class="main-content p-4">
    <div class="table-container">
        <div class="admin-table-container">
            <div class="table-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Danh sách Khách Hàng</h4><br>
                <a href="?action=admin-createCustomer" class="btn btn-primary">
                    Thêm Khách Hàng
                </a>
            </div>

            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Họ và Tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $stt = 1; foreach($customers as $customer): ?>
                    <tr>
                        <td><?= $stt++; ?></td>
                        <td><?= $customer['customer_id']; ?></td>
                        <td><?= htmlspecialchars($customer['full_name']); ?></td>
                        <td><?= htmlspecialchars($customer['email']); ?></td>
                        <td><?= htmlspecialchars($customer['phone']); ?></td>
                        <td><?= htmlspecialchars($customer['address']); ?></td>
                        <td>
                            <a href="?action=admin-updateCustomer&id=<?= $customer['customer_id']; ?>"
                                class="btn btn-sm btn-outline-success">Sửa</a>
                            <a href="?action=admin-deleteCustomer&id=<?= $customer['customer_id']; ?>"
                                onclick="return confirm('Xác nhận xóa khách hàng này?')"
                                class="btn btn-sm btn-outline-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>