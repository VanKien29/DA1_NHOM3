<style>
/* =============================== */
/*      PROFILE LAYOUT 2 CỘT      */
/* =============================== */

.profile-container {
    display: flex;
    gap: 30px;
    padding: 20px;
    align-items: flex-start;
}

/* =============================== */
/*            LEFT SIDE            */
/* =============================== */

.profile-left {
    width: 260px;
    background: #fff;
    padding: 22px;
    border-radius: 14px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    margin-top: 6px;
    /* giúp cân với bảng */
}

.profile-left img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #eee;
}

.profile-left h2 {
    margin-top: 12px;
    font-size: 20px;
    font-weight: 700;
}

.profile-left .role {
    color: #555;
    margin-bottom: 15px;
}

.info-block {
    text-align: left;
    margin-top: 12px;
}

.info-block p {
    margin: 6px 0;
    font-size: 15px;
}

.btn-edit {
    margin-top: 16px;
    padding: 10px 12px;
    width: 100%;
    background: #1976d2;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}

.btn-edit:hover {
    background: #155fa3;
}

/* =============================== */
/*            RIGHT SIDE           */
/* =============================== */

.profile-right {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.profile-card {
    background: #fff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

.profile-card h3 {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
}

/* =============================== */
/*              TABLE              */
/* =============================== */

.tour-table {
    width: 100%;
    border-collapse: collapse;
}

/* Căn thẳng các tiêu đề: Mã Tour – Tên Tour – Bắt đầu – Trạng thái */
.tour-table th,
.tour-table td {
    padding: 12px 14px !important;
    vertical-align: middle !important;
    line-height: normal !important;
    font-size: 15px;
}

/* Nền tiêu đề */
.tour-table th {
    background: #f3f4f6;
    font-weight: 600;
    color: #374151;
}

/* Hover cho bảng */
.tour-table tr:hover {
    background: #f9fafb;
}

/* Căn giữa 2 cột Bắt đầu + Trạng thái */
.tour-table th:nth-child(3),
.tour-table th:nth-child(4),
.tour-table td:nth-child(3),
.tour-table td:nth-child(4) {
    text-align: center !important;
}

/* =============================== */
/*              BADGES             */
/* =============================== */

.badge-status {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: bold;
}

.status-processing {
    background: #ffeb3b;
}

.status-done {
    background: #4caf50;
    color: white;
}

/* =============================== */
/*             POPUP EDIT          */
/* =============================== */

.edit-modal {
    position: fixed;
    inset: 0;
    display: none;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.5);
}

.edit-box {
    width: 420px;
    background: #fff;
    padding: 24px;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.edit-box input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    margin-bottom: 14px;
}

.edit-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-save {
    padding: 10px 16px;
    background: #4caf50;
    color: white;
    border-radius: 8px;
}

.btn-close {
    padding: 10px 16px;
    background: #ccc;
    border-radius: 8px;
}
</style>

<div class="profile-container">

    <!-- LEFT SIDE -->
    <div class="profile-left">
        <img src="<?= BASE_ASSETS_UPLOADS . ($guide['avatar'] ?? 'default.png') ?>">

        <h2><?= $user['name'] ?></h2>
        <p class="role"><?= $user['role'] == 'guide' ? 'Hướng Dẫn Viên' : 'Quản trị viên' ?></p>

        <div class="info-block">
            <p><strong>Email:</strong> <?= $user['email'] ?></p>
            <p><strong>CCCD:</strong> <?= $guide['cccd'] ?></p>
            <p><strong>SĐT:</strong> <?= $user['phone'] ?></p>
        </div>

        <button class="btn-edit" onclick="openEdit()">✏️ Chỉnh sửa thông tin</button>
    </div>

    <!-- RIGHT SIDE -->
    <div class="profile-right">

        <!-- TOUR HIỆN TẠI -->
        <div class="profile-card">
            <h3>🚍 Tour Hiện Tại</h3>

            <?php if (!empty($ongoingTours)) { ?>
            <table class="tour-table">
                <tr>
                    <th>Mã Tour</th>
                    <th>Tên Tour</th>
                    <th>Bắt đầu</th>
                    <th>Trạng thái</th>
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
            <p class="empty">Không có tour nào.</p>
            <?php } ?>
        </div>

        <!-- TOUR HOÀN THÀNH -->
        <div class="profile-card">
            <h3>🎉 Tour Đã Hoàn Thành</h3>

            <?php if (!empty($completedTours)) { ?>
            <table class="tour-table">
                <tr>
                    <th>Mã Tour</th>
                    <th>Tên Tour</th>
                    <th>Kết thúc</th>
                    <th>Trạng thái</th>
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
            <p class="empty">Chưa có tour hoàn thành.</p>
            <?php } ?>
        </div>

    </div>

</div>


<div class="edit-modal" id="editModal">
    <div class="edit-box">
        <h3>Chỉnh sửa thông tin</h3>

        <form method="POST" action="?action=profile-update" enctype="multipart/form-data">

            <label>Họ tên</label>
            <input type="text" name="name" value="<?= $user['name'] ?>">

            <label>Email</label>
            <input type="email" name="email" value="<?= $user['email'] ?>">

            <label>CCCD</label>
            <input type="text" name="cccd" value="<?= $guide['cccd'] ?>">

            <label>Số điện thoại</label>
            <input type="text" name="phone" value="<?= $user['phone'] ?>">

            <label>Ảnh đại diện</label>
            <input type="file" name="avatar">

            <label>Đổi mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu mới (tuỳ chọn)">

            <div style="text-align:right">
                <button type="button" class="btn-close" onclick="closeEdit()">Hủy</button>
                <button type="submit" class="btn-save">Lưu</button>
            </div>

        </form>
    </div>
</div>



<script>
function openEdit() {
    document.getElementById('editModal').style.display = 'flex';
}

function closeEdit() {
    document.getElementById('editModal').style.display = 'none';
}
</script>