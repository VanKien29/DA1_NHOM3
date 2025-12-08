<div class="container mt-4">
    <div class="header-wrapper">
        <h4 class="title">Danh Sách Tour</h4> <a href="?action=admin-createTours" class="btn btn-add"> + Thêm Tour </a>
    </div>
    <div class="filter-bar mb-3">
        <form method="GET" class="filter-form d-flex gap-2 align-items-center">
            <input type="hidden" name="action" value="admin-listTours">
            <!-- Lọc theo danh mục -->
            <select name="category" class="filter-input">
                <option value="">Danh mục</option>
                <?php foreach ($categories as $c): ?>
                <option value="<?= $c['category_id'] ?>"
                    <?= ($_GET['category'] ?? '') == $c['category_id'] ? 'selected' : '' ?>>
                    <?= $c['category_name'] ?>
                </option>
                <?php endforeach; ?>
            </select>

            <!-- Lọc theo số ngày -->
            <select name="days" class="filter-input">
                <option value="">Số ngày</option>
                <option value="1" <?= ($_GET['days'] ?? '') == '1' ? 'selected' : '' ?>>1 ngày</option>
                <option value="2" <?= ($_GET['days'] ?? '') == '2' ? 'selected' : '' ?>>2 ngày</option>
                <option value="3" <?= ($_GET['days'] ?? '') == '3' ? 'selected' : '' ?>>3 ngày</option>
                <option value="4" <?= ($_GET['days'] ?? '') == '4' ? 'selected' : '' ?>>4 ngày</option>
                <option value="5" <?= ($_GET['days'] ?? '') == '5' ? 'selected' : '' ?>>5 ngày</option>
            </select>

            <!-- Lọc theo giá -->
            <select name="price" class="filter-input">
                <option value="">Giá tour</option>
                <option value="1" <?= ($_GET['price'] ?? '') == '1' ? 'selected' : '' ?>>Dưới 1.000.000</option>
                <option value="2" <?= ($_GET['price'] ?? '') == '2' ? 'selected' : '' ?>>1.000.000 - 3.000.000</option>
                <option value="3" <?= ($_GET['price'] ?? '') == '3' ? 'selected' : '' ?>>3.000.000 - 5.000.000</option>
                <option value="4" <?= ($_GET['price'] ?? '') == '4' ? 'selected' : '' ?>>Trên 5.000.000</option>
            </select>
            <button class="btn btn-primary filter-btn">Lọc</button>
            <?php if (!empty($_GET['category']) || !empty($_GET['days']) || !empty($_GET['price'])): ?>
            <a href="?action=admin-listTours" class="btn btn-secondary filter-reset">Xóa lọc</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="tour-grid">
        <?php foreach ($tours as $t): ?>
        <div class="tour-card fade-in">

            <div class="tour-image">
                <?php if (!empty($t['tour_images'])): ?>
                <img src="<?= BASE_ASSETS_UPLOADS . $t['tour_images'] ?>" alt="">
                <?php endif; ?>
            </div>
            <div class="tour-body">
                <h4 class="tour-title"><?= $t['tour_name'] ?></h4>

                <div class="tour-meta">
                    <span><i class="fa-regular fa-clock"></i> <?= $t['days'] ?> ngày</span>
                    <span><i class="fa-solid fa-tag"></i> <?= $t['category_name'] ?></span>
                </div>

                <div class="tour-price-box">
                    <span class="adult-price"><?= number_format($t['price_adult']) ?> đ</span>

                    <span class="child-price"><?= number_format($t['price_child']) ?> đ (trẻ em)</span>
                </div>

                <p class="tour-desc">
                    <?= mb_substr($t['description'], 0, 120) ?>
                </p>

                <!-- Nút icon ở góc dưới -->
                <div class="tour-actions">
                    <a href="?action=admin-detailTour&id=<?= $t['tour_id'] ?>" class="icon-btn view">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="?action=admin-updateTours&id=<?= $t['tour_id'] ?>" class="icon-btn edit">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <a onclick="return confirm('Xóa tour này?')"
                        href="?action=admin-deleteTours&id=<?= $t['tour_id'] ?>" class="icon-btn delete">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
            </div>

        </div>
        <?php endforeach; ?>
    </div>