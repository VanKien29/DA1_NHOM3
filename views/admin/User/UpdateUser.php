<?php
// thêm require_once ở đầu mỗi file chức năng admin
require_once __DIR__ . '/../dashBoard/dashBoard.php';
?>
<div class="admin-list-container">
  <div class="admin-list-title">Cập nhật Người Dùng</div>

  <form method="POST" action="">
    <div class="form-group">
      <label>Tên đăng nhập</label>
      <input type="text" name="username" class="form-control"
             value="<?= htmlspecialchars($user['username']); ?>" required>
    </div>

    <div class="form-group">
      <label>Mật khẩu</label>
      <input type="text" name="password" class="form-control"
             value="<?= htmlspecialchars($user['password']); ?>" required>
    </div>

    <div class="form-group">
      <label>Vai trò</label>
      <select name="role" class="form-control">
        <option value="admin" <?= ($user['role']=='admin')?'selected':''; ?>>Admin</option>
        <option value="staff" <?= ($user['role']=='staff')?'selected':''; ?>>Nhân viên</option>
      </select>
    </div>

    <div class="form-group">
      <label>Họ tên</label>
      <input type="text" name="name" class="form-control"
             value="<?= htmlspecialchars($user['name']); ?>" required>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control"
             value="<?= htmlspecialchars($user['email']); ?>" required>
    </div>

    <div class="form-group">
      <label>Số điện thoại</label>
      <input type="text" name="phone" class="form-control"
             value="<?= htmlspecialchars($user['phone']); ?>" required>
    </div>

    <div class="form-action">
      <button type="submit" class="btn-add text-white">Cập nhật</button>
      <a href="?action=admin-listUsers" class="btn btn-secondary">Quay lại</a>
    </div>
  </form>
</div>

</section>
</main>
</div>
</body>
</html>
