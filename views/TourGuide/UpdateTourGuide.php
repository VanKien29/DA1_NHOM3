<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title">Cập Nhật Tour - Hướng Dẫn Viên</h4>

        <form method="POST">

            <?php if (!empty($err['empty'])): ?>
            <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>

            <!-- TOUR -->
            <div class="mb-3">
                <label>Tour</label>
                <select name="tour_id" class="form-select">
                    <?php foreach($tours as $t): ?>
                    <option value="<?= $t['tour_id'] ?>" <?= ($guide['tour_id'] == $t['tour_id']) ? 'selected' : '' ?>>
                        <?= $t['tour_name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- GUIDE -->
            <div class="mb-3">
                <label>Hướng dẫn viên</label>
                <select name="guide_id" class="form-select">
                    <?php foreach($allGuides as $g): ?>
                    <option value="<?= $g['guide_id'] ?>"
                        <?= ($guide['guide_id'] == $g['guide_id']) ? 'selected' : '' ?>>
                        <?= $g['name'] ?> (<?= $g['email'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Ngày phân công</label>
                <input type="date" class="form-control" name="assigned_date" value="<?= $guide['assigned_date'] ?>">
            </div>

            <div class="mb-3">
                <label>Ngày bắt đầu</label>
                <input type="date" class="form-control" name="start_date" value="<?= $guide['start_date'] ?>">
            </div>

            <div class="mb-3">
                <label>Ngày kết thúc</label>
                <input type="date" class="form-control" name="end_date" value="<?= $guide['end_date'] ?>">
            </div>

            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="assigned" <?= $guide['status']=='assigned'?'selected':'' ?>>Đang phân công</option>
                    <option value="completed" <?= $guide['status']=='completed'?'selected':'' ?>>Hoàn thành</option>
                    <option value="cancelled" <?= $guide['status']=='cancelled'?'selected':'' ?>>Đã hủy</option>
                </select>
            </div>

            <div class="form-action">
                <button class="btn btn-primary" type="submit">Cập nhật</button>
                <a href="?action=admin-listTourGuide" class="btn btn-secondary">Hủy</a>
            </div>

        </form>

    </div>
</div>