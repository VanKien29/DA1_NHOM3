<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Quản Trị Viên</h4>

        <form method="POST">
            <div class="form-group mb-3">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" class="form-control form-control-lg" placeholder="Nhập tên đăng nhập"
                    required>
            </div>

            <div class="form-group mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Nhập mật khẩu"
                    required>
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
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Nhập họ tên" required>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="example@email.com"
                    required>
            </div>

            <div class="form-group mb-4">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control form-control-lg" placeholder="Nhập số điện thoại"
                    required>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">Thêm Quản Trị Viên</button>
                <a href="?action=admin-listUsers" class="btn btn-secondary btn-lg ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>