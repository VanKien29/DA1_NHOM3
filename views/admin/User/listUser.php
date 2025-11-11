<?php
require_once __DIR__ . '/../dashBoard/dashBoard.php';
?>
<div class="admin-list-container">
  <div class="admin-list-title">Danh sách người dùng</div>

  <table class="admin-table">
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
            <span class="badge bg-secondary">Nhân viên</span>
          <?php endif; ?>
        </td>
        <td class="admin-action">
          <a href="?action=admin-updateUser&id=<?= $user['user_id']; ?>" class="btn btn-success">Sửa</a>
          <a href="?action=admin-deleteUser&id=<?= $user['user_id']; ?>" class="btn btn-danger"
             onclick="return confirm('Xác nhận xóa người dùng này?')">Xóa</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="admin-action">
    <a href="?action=admin-createUser" class="btn-add text-white text-decoration-none">Thêm Người Dùng</a>
  </div>
</div>

</section>
</main>
</div>
</body>
</html>
