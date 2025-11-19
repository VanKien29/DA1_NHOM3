<link rel="stylesheet" href="./views/User/formUsers.css">

<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title">Cập Nhật Hướng Dẫn Viên</h4>

        <form method="POST" enctype="multipart/form-data">
            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>

            <!-- USER -->
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

            <!-- KINH NGHIỆM -->
            <div class="mb-3">
                <label>Kinh nghiệm (năm)</label>
                <input type="number" name="experience_years" class="form-control"
                    value="<?= $guide['experience_years'] ?>">
                <div class="err"><?= $err['exp'] ?? '' ?></div>
            </div>

            <!-- CHUYÊN MÔN -->
            <div class="mb-3">
                <label>Chuyên môn</label>
                <input type="text" name="specialization" class="form-control" value="<?= $guide['specialization'] ?>">
            </div>

            <!-- GHI CHÚ -->
            <div class="mb-3">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control" rows="3"><?= $guide['note'] ?></textarea>
            </div>

            <!-- ẢNH ĐẠI DIỆN -->
            <div class="mb-3">
                <label>Ảnh đại diện</label>
                <input type="file" name="guide_images" id="guide_images" accept="image/*" class="form-control">
            </div>

            <!-- XEM TRƯỚC ẢNH MỚI -->
            <div class="mb-3">
                <img id="previewImage" src="#" 
                     style="display:none; width:120px; height:120px; object-fit:cover; border-radius:8px;">
            </div>

            <!-- HIỂN THỊ ẢNH HIỆN TẠI -->
            <?php if (!empty($guide['avt'])): ?>
            <div class="mb-3">
                <label>Ảnh hiện tại</label><br>
                <img src="<?= BASE_ASSETS_UPLOADS . $guide['avt'] ?>"
                     style="width:120px; height:120px; object-fit:cover; border-radius:8px;">
            </div>
            <?php endif; ?>

            <div class="form-action">
                <button class="btn btn-primary" type="submit">Cập nhật</button>
                <a href="?action=admin-listGuide" class="btn btn-secondary">Hủy</a>
            </div>

        </form>
    </div>
</div>

<script>
document.getElementById('guide_images').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const preview = document.getElementById('previewImage');
        preview.src = URL.createObjectURL(file);
        preview.style.display = "block";
    }
});
</script>
