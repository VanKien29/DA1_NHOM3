<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Danh Mục</h4>
        <form method="POST">
            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="text-danger"><?= $success ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label>Tên Danh Mục</label>
                <input type="text" name="category_name" class="form-control"
                    value="<?= htmlspecialchars($_POST['category_name'] ?? '') ?>">
                <?php if (!empty($err['category_name'])): ?>
                    <div class="text-danger err"><?= $err['category_name'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action">
                <button type="submit" class="btn btn-primary px-5">Thêm Danh Mục</button>
                <a href="?action=admin-listCategory" class="btn btn-secondary ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>