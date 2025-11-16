<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Báo Cáo Tour</h4>

        <form method="POST">
            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>
            <div class="form-group mb-3">
                <label>Hướng dẫn viên</label>
                <select name="guide_id" class="form-select">
                    <option value="">-- Chọn HDV --</option>
                    <?php foreach ($guides as $g): ?>
                        <option value="<?= $g['user_id']; ?>" <?= (!empty($_POST['guide_id']) && $_POST['guide_id'] == $g['user_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($g['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($err['guide_id'])): ?>
                    <div class="text-danger err"><?= $err['guide_id'] ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group mb-3">
                <label>Tour</label>
                <select name="tour_id" class="form-select">
                    <option value="">-- Chọn Tour --</option>
                    <?php foreach ($tours as $t): ?>
                        <option value="<?= $t['tour_id']; ?>" <?= (!empty($_POST['tour_id']) && $_POST['tour_id'] == $t['tour_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($t['tour_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($err['tour_id'])): ?>
                    <div class="text-danger err"><?= $err['tour_id'] ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group mb-3">
                <label>Ngày báo cáo</label>
                <input type="date" name="report_date" class="form-control"
                    value="<?= htmlspecialchars($_POST['report_date'] ?? '') ?>">
                <?php if (!empty($err['report_date'])): ?>
                    <div class="text-danger err"><?= $err['report_date'] ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group mb-3">
                <label>Nội dung</label>
                <textarea name="content" rows="4"
                    class="form-control"><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>
                <?php if (!empty($err['content'])): ?>
                    <div class="text-danger err"><?= $err['content'] ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group mb-4">
                <label>Đánh giá (1–5)</label>
                <select name="rating" class="form-select">
                    <?php
                    $selectedRating = $_POST['rating'] ?? 5;
                    for ($i = 5; $i >= 1; $i--):
                        ?>
                        <option value="<?= $i ?>" <?= ($selectedRating == $i) ? 'selected' : '' ?>>
                            <?= str_repeat('★', $i) . str_repeat('☆', 5 - $i) ?> (<?= $i ?>)
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary px-5">Thêm</button>
                <a href="?action=admin-listReports" class="btn btn-secondary px-4 ms-2">Quay lại</a>
            </div>
        </form>
    </div>
</div>