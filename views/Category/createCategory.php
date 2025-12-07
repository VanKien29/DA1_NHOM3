<div class="admin-form-container">
    <div class="admin-form-card">

        <h4 class="form-title">Thêm Danh Mục</h4>

        <form method="POST">

            <?php if (!empty($err['empty'])): ?>
            <div class="err mb-2"><?= $err['empty'] ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
            <div class="text-success mb-2"><?= $success ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="category_name">Tên Danh Mục</label>
                <input type="text" id="category_name" name="category_name" class="form-control"
                    value="<?= htmlspecialchars($_POST['category_name'] ?? '') ?>">

                <?php if (!empty($err['name'])): ?>
                <div class="err"><?= $err['name'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-action">
                <button type="submit" class="btn btn-primary px-5">Thêm Danh Mục</button>
                <a href="?action=admin-listCategory" class="btn btn-secondary px-4">Quay lại</a>
            </div>

        </form>

    </div>
</div>