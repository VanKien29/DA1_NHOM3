<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Cập Nhật Báo Cáo Tour</h4>

        <form method="POST">
            <div class="form-group mb-3">
                <label>Hướng dẫn viên</label>
                <select name="guide_id" class="form-select">
                    <?php foreach ($guides as $g): ?>
                        <option value="<?= $g['user_id'] ?>" <?= ($report['guide_id'] == $g['user_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($g['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Tour</label>
                <select name="tour_id" class="form-select">
                    <?php foreach ($tours as $t): ?>
                        <option value="<?= $t['tour_id'] ?>" <?= ($report['tour_id'] == $t['tour_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($t['tour_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Ngày báo cáo</label>
                <input type="date" name="report_date" class="form-control" value="<?= $report['report_date'] ?>">
            </div>
            <div class="form-group mb-3">
                <label>Nội dung</label>
                <textarea name="content" rows="4"
                    class="form-control"><?= htmlspecialchars($report['content']) ?></textarea>
            </div>
            <div class="form-group mb-4">
                <label>Đánh giá (1–5)</label>
                <select name="rating" class="form-select">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <option value="<?= $i ?>" <?= ($report['rating'] == $i) ? 'selected' : '' ?>>
                            <?= str_repeat('★', $i) . str_repeat('☆', 5 - $i) ?> (<?= $i ?>)
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Xác nhận</button>
                <a href="?action=admin-listReports" class="btn btn-secondary px-4 ms-2">Quay lại</a>
            </div>

        </form>
    </div>
</div>