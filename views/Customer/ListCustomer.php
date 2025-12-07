<div class="main-content p-4">
    <div class="table-container">
        <div class="admin-table-container">
            <div class="table-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Danh Sách Khách Hàng</h4>
                <a href="?action=admin-createCustomer" class="btn btn-primary">
                    + Thêm Khách Hàng
                </a>
            </div>
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ và Tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Tuổi</th>
                        <th>Địa chỉ</th>
                        <th>Loại Khách</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $stt = 1; foreach($customers as $customer): ?>
                    <tr>
                        <td><?= $stt++; ?></td>
                        <td><?= htmlspecialchars($customer['full_name']); ?></td>
                        <td><?= htmlspecialchars($customer['email']); ?></td>
                        <td><?= htmlspecialchars($customer['phone']); ?></td>
                        <td><?= htmlspecialchars($customer['age']); ?> tuổi</td>
                        <td><?= htmlspecialchars($customer['address']); ?></td>
                        <td><?= htmlspecialchars($customer['role']) == "adult" ? "Người lớn" : (htmlspecialchars($customer['role']) == "vip" ? "VIP" : "Trẻ em"); ?>
                        </td>
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