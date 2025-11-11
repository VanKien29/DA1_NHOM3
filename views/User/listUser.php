<div class="main-content p-4">
    <div class="table-container">
        <div class="admin-table-container">
            <div class="table-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Danh sách Người Dùng</h4><br>
                <a href="?action=admin-createUsers" class="btn btn-primary">
                    Thêm Người Dùng
                </a>
            </div>

            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Tên đăng nhập</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Vai trò</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $stt = 1; foreach($users as $user): ?>
                    <tr>
                        <td><?= $stt++; ?></td>
                        <td><?= $user['user_id']; ?></td>
                        <td><?= htmlspecialchars($user['username']); ?></td>
                        <td><?= htmlspecialchars($user['name']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td><?= htmlspecialchars($user['phone']); ?></td>
                        <td>
                            <?php if($user['role'] == 'admin'): ?>
                            <span class="badge bg-success">Admin</span>
                            <?php else: ?>
                            <span class="badge bg-secondary">Hướng Dẫn Viên</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="?action=admin-updateUsers&id=<?= $user['user_id']; ?>"
                                class="btn btn-sm btn-outline-success">Sửa</a>
                            <a href="?action=admin-deleteUsers&id=<?= $user['user_id']; ?>"
                                onclick="return confirm('Xác nhận xóa người dùng này?')"
                                class="btn btn-sm btn-outline-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>