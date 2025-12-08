<div class="container mt-4">
    <div class="header-wrapper">
        <h4 class="title">Danh Sách Tour</h4> <a href="?action=admin-createTours" class="btn btn-add"> + Thêm Tour </a>
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