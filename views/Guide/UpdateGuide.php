<link rel="stylesheet" href="./views/User/formUsers.css">

<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title">Cập Nhật Hướng Dẫn Viên</h4>

        <form method="POST" enctype="multipart/form-data">
            <?php if (!empty($err['empty'])): ?>
            <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label>Người dùng (User)</label>
                <select name="user_id" class="form-select">
                    <?php foreach ($users as $u): ?>
                    <option value="<?= $u['user_id'] ?>" <?= ($guide['user_id'] == $u['user_id']) ? 'selected' : '' ?>>
                        <?= $u['name'] ?> (<?= $u['email'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
                <div class="err"><?= $err['user_id'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Ảnh hướng dẫn viên</label>
                <input type="file" name="avatar" class="form-control">
                <?php if (!empty($guide['avatar'])): ?>
                <img src="<?= BASE_ASSETS_UPLOADS . $guide['avatar'] ?>" width="120" class="mt-2">
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label>Căn cước công dân</label>
                <input type="number" name="cccd" class="form-control" value="<?= $guide['cccd'] ?>">
                <div class="err"><?= $err['cccd'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Kinh nghiệm (năm)</label>
                <input type="number" name="experience_years" class="form-control"
                    value="<?= $guide['experience_years'] ?>">
                <div class="err"><?= $err['experience_years'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Chuyên môn</label>
                <input type="text" name="specialization" class="form-control" value="<?= $guide['specialization'] ?>">
                <div class="err"><?= $err['specialization'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control" rows="3"><?= $guide['note'] ?></textarea>
                <div class="err"><?= $err['note'] ?? '' ?></div>
            </div>

            <div class="form-action">
                <button class="btn btn-primary" type="submit">Cập nhật</button>
                <a href="?action=admin-listGuide" class="btn btn-secondary">Quay lại</a>
            </div>

        </form>
    </div>
</div>