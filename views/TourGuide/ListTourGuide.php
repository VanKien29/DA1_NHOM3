<link rel="stylesheet" href="./views/User/listUsers.css">

<div class="table-container">
    <h4>Danh Sách Hướng Dẫn Viên</h4>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Id</th>
                <th>Tên HDV</th>
                <th>Tên Tour</th>
                <th>Booking id</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Kết Thúc</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php $stt = 1; foreach ($guides as $g): ?>
            <tr>
                <td><?= $stt++ ?></td>
                <td><?= $g['id'] ?></td>
                <td><?= $g['user_name'] ?></td>
                <td><?= $g['tour_name'] ?></td>
                <td><?= $g['booking_id'] ?></td>
                <td><?= $g['start_date'] ?></td>
                <td><?= $g['end_date'] ?></td>
                <td><?= $g['status'] ?></td>
                <td>
                    <a href="?action=admin-updateTourGuide&id=<?= $g['guide_id'] ?>"
                        class="btn btn-outline-success btn-sm">Sửa</a>

                    <a href="?action=admin-deleteTourGuide&id=<?= $g['guide_id'] ?>"
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