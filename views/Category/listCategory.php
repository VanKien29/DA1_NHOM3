<div class="admin-table-container">
    <div class="admin-table-container">
        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Danh Sách Danh Mục</h4>
            <a href="?action=admin-createCategory" class="btn btn-primary">
                + Thêm Danh Mục
            </a>
        </div>
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Tên Danh Mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1; foreach ($categories as $category): ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= htmlspecialchars($category['category_name']) ?></td>
                    <td>
                        <a href="?action=admin-updateCategory&id=<?= $category['category_id'] ?>"
                            class="btn btn-outline-success btn-sm">Sửa</a>
                        <a href="?action=admin-deleteCategory&id=<?= $category['category_id'] ?>"
                            class="btn btn-outline-danger btn-sm" onclick="return confirm('Xóa danh mục này?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>