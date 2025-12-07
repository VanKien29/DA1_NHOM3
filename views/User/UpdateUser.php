<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Quản Trị Viên</h4>

        <form method="POST" action="">
            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="text-danger"><?= $success ?></div>
            <?php endif; ?>
            <div class="form-group mb-3">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['username'] ?? '') ?>">
                <?php if (!empty($err['username'])): ?>
                    <div class="text-danger err"><?= $err['username'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label>Mật khẩu</label>
                <input type="text" name="password" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['password'] ?? '') ?>">
                <?php if (!empty($err['password'])): ?>
                    <div class="text-danger err"><?= $err['password'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label>Vai trò</label>
                <select name="role" class="form-select form-select-lg">
                    <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="guide" <?= ($user['role'] == 'guide') ? 'selected' : ''; ?>>Hướng Dẫn Viên</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['name'] ?? '') ?>">
                <?php if (!empty($err['name'])): ?>
                    <div class="text-danger err"><?= $err['name'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                <?php if (!empty($err['email'])): ?>
                    <div class="text-danger err"><?= $err['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-4">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                <?php if (!empty($err['phone'])): ?>
                    <div class="text-danger err"><?= $err['phone'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-4">
                <label>Số căn cước công dân</label>
                <input type="text" name="cccd" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($user['cccd'] ?? '') ?>">
                <?php if (!empty($err['cccd'])): ?>
                    <div class="text-danger err"><?= $err['cccd'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">Cập nhật</button>
                <a href="?action=admin-listUsers" class="btn btn-secondary btn-lg ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>