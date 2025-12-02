<div class="admin-form-container">
    <div class="admin-form-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="form-title mb-0">Chi Tiết Tour</h4>
            <div>
                <a href="?action=admin-updateTours&id=<?= $tour['tour_id'] ?>" class="btn btn-outline-success btn-sm">
                    Sửa tour / lịch trình
                </a>
                <a href="?action=admin-listTours" class="btn btn-sm btn-outline-back">
                    Quay lại
                </a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 mb-3 mb-md-0 text-center">
                <?php if (!empty($tour['tour_images'])): ?>
                <img src="image/TourImages/<?= htmlspecialchars($tour['tour_images']) ?>" class="img-fluid rounded"
                    style="max-height:220px;object-fit:cover;">
                <?php else: ?>
                <div class="text-muted fst-italic">Chưa có ảnh tour</div>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <h5 class="mb-2"><?= htmlspecialchars($tour['tour_name']) ?></h5>
                <p class="mb-1"><strong>Danh mục:</strong> <?= htmlspecialchars($tour['category_name']) ?></p>
                <p class="mb-1"><strong>Giá:</strong> <?= number_format($tour['price']) ?> đ</p>
                <p class="mb-1"><strong>Thời lượng:</strong> <?= (int)$tour['days'] ?> ngày</p>
                <p class="mt-2"><strong>Mô tả:</strong><br><?= nl2br(htmlspecialchars($tour['description'])) ?></p>
            </div>
        </div>

        <hr>

        <h5 class="mb-3">Lịch trình tour</h5>

        <?php if (empty($schedules)): ?>
        <div class="alert alert-warning">
            Chưa có lịch trình nào cho tour này.
        </div>
        <?php else: ?>
        <div class="tour-schedule-list">
            <?php foreach ($schedules as $s): ?>
            <div class="schedule-day-box mb-3 p-3 border rounded">
                <h6 class="mb-2">
                    Ngày <?= (int)$s['day_number'] ?>:
                    <?= htmlspecialchars($s['title']) ?>
                </h6>
                <p class="mb-0"><?= nl2br(htmlspecialchars($s['description'])) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>