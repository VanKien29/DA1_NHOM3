<div class="profile-wrapper">
    <div class="profile-left">
       <img src="<?= BASE_ASSETS_UPLOADS . ($guide['avatar'] ?? 'default.png') ?>" 
     class="rounded shadow-sm" width="120">

<h2 class="profile-name"><?= $user['name'] ?></h2>
<p class="role"><?= $user['role'] == 'guide' ? 'Hướng Dẫn Viên' : 'Quản Trị Viên' ?></p>

<div class="info-block">
    <p><strong>Email:</strong> <?= $user['email'] ?></p>
    <p><strong>SĐT:</strong> <?= $user['phone'] ?></p>
</div>

        <button class="btn-edit" onclick="openEdit()">✏️ Chỉnh sửa thông tin</button>
    </div>
    <div class="profile-card-table">
    <h3>🚍 Tour Hiện Tại</h3>

    <?php if (!empty($ongoingTours)) { ?>
        <table class="tour-table">
            <tr>
                <th>Mã Tour</th>
                <th>Tên Tour</th>
                <th>Ngày Bắt Đầu</th>
                <th>Trạng Thái</th>
            </tr>

            <?php foreach ($ongoingTours as $t) { ?>
                <tr>
                    <td><?= $t['booking_id'] ?></td>
                    <td><?= $t['tour_name'] ?></td>
                    <td><?= $t['start_date'] ?></td>
                    <td><span class="badge-status status-processing">Đang diễn ra</span></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p class="empty">Không có tour nào đang diễn ra.</p>
    <?php } ?>
</div>


<div class="profile-card-table">
    <h3>🎉 Tour Đã Hoàn Thành</h3>

    <?php if (!empty($completedTours)) { ?>
        <table class="tour-table">
            <tr>
                <th>Mã Tour</th>
                <th>Tên Tour</th>
                <th>Ngày Kết Thúc</th>
                <th>Trạng Thái</th>
            </tr>

            <?php foreach ($completedTours as $t) { ?>
                <tr>
                    <td><?= $t['booking_id'] ?></td>
                    <td><?= $t['tour_name'] ?></td>
                    <td><?= $t['end_date'] ?></td>
                    <td><span class="badge-status status-done">Hoàn thành</span></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p class="empty">Chưa hoàn thành tour nào.</p>
    <?php } ?>
</div>

        <div class="card">
            <h3>🏆 Thành Tích Cá Nhân</h3>
            <ul class="achievements">
                <li>✔ Hoàn thành <strong><?= count($completedTours) ?></strong> tour</li>
                <li>✔ Chưa có tour bị hủy</li>
                <li>✔ Đánh giá trung bình: <strong>4.9/5 ⭐</strong></li>
            </ul>
        </div>

    </div>
</div>
<div class="edit-modal" id="editModal">
    <div class="edit-box">
        <h3>Chỉnh sửa thông tin</h3>

        <form method="POST" action="?action=profile-update" enctype="multipart/form-data">
            <label>Họ tên</label>
            <input type="text" name="name" value="<?= $user['name'] ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= $user['email'] ?>" required>

            <label>SĐT</label>
            <input type="text" name="phone" value="<?= $user['phone'] ?>" required>

            <label>Ảnh đại diện</label>
            <input type="file" name="avatar">

            <div class="edit-actions">
                <button type="button" class="btn-close" onclick="closeEdit()">Hủy</button>
                <button type="submit" class="btn-save">Lưu</button>
            </div>
        </form>
    </div>
</div>


<script>
function openEdit() { document.getElementById('editModal').style.display = 'flex'; }
function closeEdit() { document.getElementById('editModal').style.display = 'none'; }
</script>
