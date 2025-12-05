<link rel="stylesheet" href="./views/Tour/formTours.css">

<?php
$current_step = $current_step ?? 1;
$mapSchedule = [];
if (!empty($schedules)) {
    foreach ($schedules as $s) {
        $day = (int)$s['day_number'];
        $mapSchedule[$day] = $s;
    }
}
?>

<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-3">Cập Nhật Tour</h4>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="current_step" value="<?= (int)$current_step ?>">

            <?php if (!empty($err['empty'])): ?>
            <div class="text-danger mb-2"><?= htmlspecialchars($err['empty']) ?></div>
            <?php endif; ?>

            <!-- =============== STEP 1: Thông tin tour =============== -->
            <?php if ($current_step == 1): ?>
            <div class="steps-indicator mb-3">
                <span class="step active">1. Thông tin tour</span>
                <span class="step">2. Lịch trình</span>
            </div>

            <div class="mb-3">
                <label class="form-label">Tên tour</label>
                <input type="text" name="tour_name" class="form-control"
                    value="<?= htmlspecialchars($_POST['tour_name'] ?? $tour['tour_name']) ?>">
                <?php if (!empty($err['tour_name'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['tour_name']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>
                <?php if (!empty($tour['tour_images'])): ?>
                <img src="image/TourImages/<?= htmlspecialchars($tour['tour_images']) ?>" width="120" height="80"
                    style="object-fit:cover;border-radius:8px;">
                <?php else: ?>
                <span class="text-muted">Chưa có ảnh</span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Đổi ảnh (nếu muốn)</label>
                <input type="file" name="tour_images" class="form-control">
                <input type="hidden" name="tour_images_old" value="<?= htmlspecialchars($tour['tour_images']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control"
                    rows="3"><?= htmlspecialchars($_POST['description'] ?? $tour['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price_adult" class="form-control"
                    value="<?= htmlspecialchars($_POST['price_adult'] ?? $tour['price_adult']) ?>">
                <?php if (!empty($err['price_adult'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['price_adult']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price_child" class="form-control"
                    value="<?= htmlspecialchars($_POST['price_child'] ?? $tour['price_child']) ?>">
                <?php if (!empty($err['price_child'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['price_child']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price_vip" class="form-control"
                    value="<?= htmlspecialchars($_POST['price_vip'] ?? $tour['price_vip']) ?>">
                <?php if (!empty($err['price_vip'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['price_vip']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Số ngày tour</label>
                <input type="number" name="days" class="form-control"
                    value="<?= htmlspecialchars($_POST['days'] ?? $tour['days']) ?>" min="1">
                <?php if (!empty($err['days'])): ?>
                <div class="text-danger err"><?= htmlspecialchars($err['days']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-select">
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id'] ?>"
                        <?= (($_POST['category_id'] ?? $tour['category_id']) == $cat['category_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="text-center mt-3 d-flex justify-content-between">
                <a href="?action=admin-listTours" class="btn btn-secondary px-4">Quay lại</a>
                <button type="submit" name="next_1" value="1" class="btn btn-primary px-5">Tiếp tục</button>
            </div>
            <?php endif; ?>

            <!-- =============== STEP 2: Lịch trình =============== -->
            <?php if ($current_step == 2): ?>
            <?php
                $tour_name   = $_POST['tour_name']   ?? $tour['tour_name'];
                $description = $_POST['description'] ?? $tour['description'];
                $price_adult       = $_POST['price_adult']       ?? $tour['price_adult'];
                $price_child       = $_POST['price_child']       ?? $tour['price_child'];
                $price_vip         = $_POST['price_vip']         ?? $tour['price_vip'];
                $days        = (int)($_POST['days']  ?? $tour['days']);
                $category_id = $_POST['category_id'] ?? $tour['category_id'];
                $tour_images = $_POST['tour_images_saved'] ?? ($_POST['tour_images_old'] ?? $tour['tour_images']);
                if ($days < 1) $days = 1;
            ?>

            <!-- giữ lại thông tin tour -->
            <input type="hidden" name="tour_name" value="<?= htmlspecialchars($tour_name) ?>">
            <input type="hidden" name="description" value="<?= htmlspecialchars($description) ?>">
            <input type="hidden" name="price_adult" value="<?= htmlspecialchars($price_adult) ?>">
            <input type="hidden" name="price_child" value="<?= htmlspecialchars($price_child) ?>">
            <input type="hidden" name="price_vip" value="<?= htmlspecialchars($price_vip) ?>">
            <input type="hidden" name="days" value="<?= htmlspecialchars($days) ?>">
            <input type="hidden" name="category_id" value="<?= htmlspecialchars($category_id) ?>">
            <input type="hidden" name="tour_images_saved" value="<?= htmlspecialchars($tour_images) ?>">

            <div class="steps-indicator mb-3">
                <span class="step">1. Thông tin tour</span>
                <span class="step active">2. Lịch trình</span>
            </div>

            <div class="mb-3">
                <strong>Lịch trình tour:</strong> <?= htmlspecialchars($tour_name) ?> (<?= $days ?> ngày)
            </div>

            <?php for ($d = 1; $d <= $days; $d++): 
                $postTitle = $_POST['schedule_title'][$d-1] ?? null;
                $postDesc  = $_POST['schedule_description'][$d-1] ?? null;

                $dbTitle = $mapSchedule[$d]['title'] ?? '';
                $dbDesc  = $mapSchedule[$d]['description'] ?? '';

                $valTitle = $postTitle !== null ? $postTitle : $dbTitle;
                $valDesc  = $postDesc  !== null ? $postDesc  : $dbDesc;
            ?>
            <div class="schedule-day-box mb-3 p-3 border rounded">
                <h6 class="mb-2">Ngày <?= $d ?></h6>
                <input type="hidden" name="day_number[]" value="<?= $d ?>">

                <div class="mb-2">
                    <label class="form-label">Tiêu đề ngày</label>
                    <input type="text" name="schedule_title[]" class="form-control"
                        value="<?= htmlspecialchars($valTitle) ?>">
                </div>

                <div class="mb-2">
                    <label class="form-label">Nội dung / Hoạt động</label>
                    <textarea name="schedule_description[]" rows="3"
                        class="form-control"><?= htmlspecialchars($valDesc) ?></textarea>
                </div>
            </div>
            <?php endfor; ?>

            <div class="text-center mt-3 d-flex justify-content-between">
                <button type="submit" name="prev_step" value="1" class="btn btn-outline-secondary px-4">
                    ← Quay lại
                </button>
                <button type="submit" name="final_submit" value="1" class="btn btn-primary px-5">
                    Lưu thay đổi
                </button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>