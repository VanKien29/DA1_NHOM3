<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Quản Trị Viên</h4>

        <form method="POST">
            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>
            <div class="form-group mb-3">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" class="form-control form-control-lg" placeholder="Nhập tên đăng nhập"
                    value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                <?php if (!empty($err['username'])): ?>
                    <div class="text-danger err"><?= $err['username'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Nhập mật khẩu"
                    value="<?= htmlspecialchars($_POST['password'] ?? '') ?>">
                <?php if (!empty($err['password'])): ?>
                    <div class="text-danger err"><?= $err['password'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label>Vai trò</label>
                <select name="role" class="form-select form-select-lg">
                    <option value="1">Admin</option>
                    <option value="2">Hướng Dẫn Viên</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Nhập họ tên"
                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                <?php if (!empty($err['name'])): ?>
                    <div class="text-danger err"><?= $err['name'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control form-control-lg" placeholder="example@email.com"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <?php if (!empty($err['email'])): ?>
                    <div class="text-danger err"><?= $err['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-4">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control form-control-lg" placeholder="Nhập số điện thoại"
                    value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                <?php if (!empty($err['phone'])): ?>
                    <div class="text-danger err"><?= $err['phone'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-4">
                <label>Căn cước công dân</label>
                <input type="text" name="cccd" class="form-control form-control-lg"
                    placeholder="Nhập số căn cước công dân" value="<?= htmlspecialchars($_POST['cccd'] ?? '') ?>">
                <?php if (!empty($err['cccd'])): ?>
                    <div class="text-danger err"><?= $err['cccd'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">Thêm Quản Trị Viên</button>
                <a href="?action=admin-listUsers" class="btn btn-secondary btn-lg ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>