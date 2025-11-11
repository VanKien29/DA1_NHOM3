<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Người Dùng</h4>

        <form method="POST" action="">
            <div class="form-group mb-3">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['username']); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Mật khẩu</label>
                <input type="text" name="password" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['password']); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Vai trò</label>
                <select name="role" class="form-select form-select-lg">
                    <option value="admin" <?= ($user['role']=='admin')?'selected':''; ?>>Admin</option>
                    <option value="staff" <?= ($user['role']=='staff')?'selected':''; ?>>Nhân viên</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group mb-4">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['phone']); ?>" required>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">Cập nhật</button>
                <a href="?action=admin-listUsers" class="btn btn-secondary btn-lg ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>