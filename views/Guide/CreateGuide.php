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
                    <option value="<?= $u['user_id'] ?>"
                        <?= (isset($_POST['user_id']) && $_POST['user_id'] == $u['user_id']) ? 'selected' : '' ?>>
                        <?= $u['name'] ?> (<?= $u['email'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
    <label for="guide_images" class="form-label">Ảnh đại diện</label>
    <input type="file" name="guide_images" id="guide_images" accept="image/*" class="form-control">
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