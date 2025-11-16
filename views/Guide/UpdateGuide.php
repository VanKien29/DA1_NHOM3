<link rel="stylesheet" href="./views/User/formUsers.css">

<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title">Cập Nhật Hướng Dẫn Viên</h4>

        <form method="POST">
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
            </div>

            <div class="mb-3">
                <label>Kinh nghiệm (năm)</label>
                <input type="number" name="experience_years" class="form-control"
                    value="<?= $guide['experience_years'] ?>">
                <div class="err"><?= $err['exp'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Chuyên môn</label>
                <input type="text" name="specialization" class="form-control" value="<?= $guide['specialization'] ?>">
            </div>

            <div class="mb-3">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control" rows="3"><?= $guide['note'] ?></textarea>
            </div>

            <div class="form-action">
                <button class="btn btn-primary" type="submit">Cập nhật</button>
                <a href="?action=admin-listGuide" class="btn btn-secondary">Hủy</a>
            </div>

        </form>
    </div>
</div>