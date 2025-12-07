<div class="table-container">
    <div class="table-header d-flex justify-content-between align-items-center mb-3">
        <h4 class="title">Danh Sách Hướng Dẫn Viên</h4>
        <a href="?action=admin-createGuide" class="btn btn-primary">
            + Thêm Hướng Dẫn Viên
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Ảnh đại diện</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Kinh nghiệm</th>
                <th>Chuyên môn</th>
                <th>Ghi chú</th>
                <th style="text-align: center;">Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php $stt = 1; foreach ($guides as $g): ?>
            <tr>
                <td><?= $stt++ ?></td>
                <td>
                    <?php if (!empty($g['avatar'])): ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . $g['avatar'] ?>" width="60">
                    <?php endif; ?>
                </td>
                <td class="fw-semibold"><?= $g['name'] ?></td>
                <td><?= $g['email'] ?></td>
                <td><?= $g['phone'] ?></td>
                <td><?= $g['experience_years'] ?> năm</td>
                <td><?= $g['specialization'] ?></td>
                <td><?= $g['note'] ?></td>
                <td>
                    <a href="?action=admin-detailGuide&id=<?= $g['guide_id']; ?>"
                        class="btn btn-sm btn-info btn-outline-detail">Chi
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
</div>