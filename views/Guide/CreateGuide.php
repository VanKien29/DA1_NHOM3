<link rel="stylesheet" href="./views/User/formUsers.css">

<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title">Thêm Hướng Dẫn Viên</h4>

        <form method="POST" enctype="multipart/form-data">
            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label>Người dùng (User)</label>
                <select name="user_id" class="form-select">
                    <option value="">Chọn user</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $u['user_id'] ?>" <?= (isset($_POST['user_id']) && $_POST['user_id'] == $u['user_id']) ? 'selected' : '' ?>>
                            <?= $u['name'] ?> (<?= $u['email'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Ảnh hướng dẫn viên</label>
                <input type="file" name="avatar" class="form-control">
                <?php if (!empty($err['avatar'])): ?>
                    <div class="text-danger err"><?= htmlspecialchars($err['avatar']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $_POST['email'] ?? '' ?>">
                <div class="err"><?= $err['exp'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Số điện thoại</label>
                <input type="number" name="phone" class="form-control" value="<?= $_POST['phone'] ?? '' ?>">
                <div class="err"><?= $err['exp'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Căm cước công dân</label>
                <input type="number" name="cccd" class="form-control" value="<?= $_POST['cccd'] ?? '' ?>">
                <div class="err"><?= $err['exp'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Kinh nghiệm (năm)</label>
                <input type="number" name="experience_years" class="form-control"
                    value="<?= $_POST['experience_years'] ?? '' ?>">
                <div class="err"><?= $err['exp'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Chuyên môn</label>
                <input type="text" name="specialization" class="form-control"
                    value="<?= $_POST['specialization'] ?? '' ?>">
                <div class="err"><?= $err['specialization'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control" rows="3"><?= $_POST['note'] ?? '' ?></textarea>
            </div>

            <div class="form-action">
                <button class="btn btn-primary" type="submit">Thêm</button>
                <a href="?action=admin-listGuide" class="btn btn-secondary">Hủy</a>
            </div>

        </form>
    </div>
</div>