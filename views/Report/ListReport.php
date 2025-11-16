<div class="admin-table-container">
    <div class="table-header d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Danh Sách Báo Cáo Tour</h4>
        <a href="?action=admin-createReport" class="btn btn-primary">
            + Thêm Báo Cáo Tour
        </a>
    </div>

    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>ID Report</th>
                <th>Hướng Dẫn Viên</th>
                <th>Tour</th>
                <th>Ngày Báo Cáo</th>
                <th>Nội dung</th>
                <th>Đánh giá</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php $stt = 1;
            foreach ($reports as $r): ?>
                <tr>
                    <td><?= $stt++; ?></td>
                    <td><?= $r['report_id']; ?></td>
                    <td><?= htmlspecialchars($r['guide_name']); ?></td>
                    <td><?= htmlspecialchars($r['tour_name']); ?></td>
                    <td><?= htmlspecialchars($r['report_date']); ?></td>

                    <td style="max-width:240px;">
                        <?= htmlspecialchars($r['content']); ?>
                    </td>

                    <td>
                        <span class="badge bg-warning text-dark fw-bold">
                            <?= $r['rating'] ?> ★
                        </span>
                    </td>

                    <td>
                        <a href="?action=admin-updateReport&id=<?= $r['report_id'] ?>"
                            class="btn btn-outline-success btn-sm">Sửa</a>

                        <a href="?action=admin-deleteReport&id=<?= $r['report_id'] ?>" class="btn btn-outline-danger btn-sm"
                            onclick="return confirm('Xóa báo cáo này?')">
                            Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>