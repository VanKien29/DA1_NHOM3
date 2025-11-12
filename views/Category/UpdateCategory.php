<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Danh Mục</h4>

        <form method="POST">
            <div class="mb-3">
                <label>Tên Danh Mục</label>
                <input type="text" name="category_name" class="form-control"
                    value="<?= htmlspecialchars($category['category_name']) ?>" required>
            </div>

            <div class="form-action">
                <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                <a href="?action=admin-listCategory" class="btn btn-secondary ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>