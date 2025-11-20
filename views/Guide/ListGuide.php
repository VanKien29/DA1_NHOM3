<link rel="stylesheet" href="./views/User/listUsers.css">

<div class="table-container">
    <h4>Danh Sách Hướng Dẫn Viên</h4>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Ảnh đại diện</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Kinh nghiệm</th>
                <th>Chuyên môn</th>
                <th>Ghi chú</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php $stt = 1; foreach ($guides as $g): ?>
            <tr>
                <td><?= $stt++ ?></td>
                <td><?= $g['guide_id'] ?></td>
                <td>
                    <?php if (!empty($g['avatar'])): ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . $g['avatar'] ?>" width="100">
                    <?php endif; ?>
                </td>
                <td class="fw-semibold"><?= $g['name'] ?></td>
                <td><?= $g['email'] ?></td>
                <td><?= $g['phone'] ?></td>
                <td><?= $g['experience_years'] ?> năm</td>
                <td><?= $g['specialization'] ?></td>
                <td><?= $g['note'] ?></td>
                <td>
                    <a href="?action=admin-detailGuide&id=<?= $g['guide_id']; ?>" class="btn btn-sm btn-info">Chi
                        tiết</a>
                    <a href="?action=admin-updateGuide&id=<?= $g['guide_id'] ?>"
                        class="btn btn-outline-success btn-sm">Sửa</a>
                    <a href="?action=admin-deleteGuide&id=<?= $g['guide_id'] ?>"
                        onclick="return confirm('Bạn chắc chắn muốn xoá?')"
                        class="btn btn-outline-danger btn-sm">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="add-btn-container">
        <a href="?action=admin-createGuide" class="btn btn-success">+ Thêm Hướng Dẫn Viên</a>
    </div>
</div>