<div class="admin-form-container">
    <div class="detail-card">
        <div class="detail-header">
            <div>
                <h2 class="detail-title"><?= htmlspecialchars($tour['tour_name']) ?></h2>
                <span class="badge-category"><?= htmlspecialchars($tour['category_name']) ?></span>
            </div>
            <div>
                <a href="?action=admin-updateTours&id=<?= $tour['tour_id'] ?>" class="btn btn-edit">Sửa tour</a>

                <a href="?action=admin-listTours" class="btn btn-back">Quay lại</a>
            </div>
        </div>
        <div class="info-grid">
            <div class="info-item">
                <strong>Giá người lớn</strong>
                <span><?= number_format($tour['price_adult']) ?> đ</span>
            </div>
            <div class="info-item">
                <strong>Giá trẻ em</strong>
                <span><?= number_format($tour['price_child']) ?> đ</span>
            </div>
            <div class="info-item">
                <strong>Số ngày</strong>
                <span><?= (int)$tour['days'] ?> ngày</span>
            </div>
            <div class="info-item">
                <strong>Danh mục</strong>
                <span><?= htmlspecialchars($tour['category_name']) ?></span>
            </div>
        </div>
        <div class="desc-box mt-3">
            <strong>Mô tả:</strong><br>
            <?= nl2br(htmlspecialchars($tour['description'])) ?>
        </div>
        <h4 class="schedule-title">📌 Lịch trình tour</h4>
        <?php if (!empty($schedules)): ?>
        <div class="timeline">
            <?php foreach ($schedules as $s): ?>
            <div class="timeline-item">
                <h6>Ngày <?= $s['day_number'] ?> – <?= htmlspecialchars($s['title']) ?></h6>
                <p><?= nl2br(htmlspecialchars($s['description'])) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="alert alert-warning mt-3">Chưa có lịch trình cho tour này.</div>
        <?php endif; ?>
    </div>
</div>