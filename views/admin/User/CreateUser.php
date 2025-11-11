<?php
require_once __DIR__ . '/../dashBoard/dashBoard.php';
?>
<div class="admin-list-container">
  <div class="admin-list-title">Thêm Người Dùng</div>

  <form method="POST">
    <div class="form-group">
      <label>Tên đăng nhập</label>
      <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Mật khẩu</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Vai trò</label>
      <select name="role" class="form-control">
        <option value="admin">Admin</option>
        <option value="staff">Nhân viên</option>
      </select>
    </div>

    <div class="form-group">
      <label>Họ tên</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Số điện thoại</label>
      <input type="text" name="phone" class="form-control" required>
    </div>

    <div class="form-action">
      <button type="submit" class="btn-add text-white">Thêm người dùng</button>
      <a href="?action=admin-listUsers" class="btn btn-secondary">Quay lại</a>
    </div>
  </form>
</div>

</section>
</main>
</div>
</body>
</html>
