<div class="stats-wrapper">

    <h2 class="stats-title">📊 Thống Kê Hoạt Động Hướng Dẫn Viên</h2>

    <!-- ===== DONUT + HEAT BAR + BAR CHART ===== -->
    <div class="stats-grid">

        <!-- DONUT CHART -->
        <div class="card donut-box">
            <h3>Tỷ lệ tour hoàn thành</h3>

            <?php $percent = $totalTours > 0 ? round(($finishedTours / $totalTours) * 100) : 0; ?>

            <div class="donut">
                <svg viewBox="0 0 36 36">
                    <path class="bg"
                        d="M18 2 a 16 16 0 0 1 0 32 a 16 16 0 0 1 0 -32" />
                    <path class="meter"
                        stroke-dasharray="<?= $percent ?>, 100"
                        d="M18 2 a 16 16 0 0 1 0 32 a 16 16 0 0 1 0 -32" />
                </svg>

                <div class="donut-text"><?= $percent ?>%</div>
            </div>
        </div>

        <!-- HEAT BAR -->
        <div class="card heat-box">
            <h3>Mức độ hoạt động</h3>
            <div class="heat-bar">
                <div class="heat-fill" style="width: <?= $percent ?>%"></div>
            </div>
            <p class="heat-label"><?= $percent ?>% tổng tour đã hoàn thành</p>
        </div>

        <!-- SOFT BAR CHART -->
        <div class="card chart-box">
            <h3>Biểu đồ số tour</h3>

            <div class="soft-chart">
                <div class="bar-item">
                    <div class="bar-fill fill-blue" style="height: <?= $totalTours * 12 ?>px"></div>
                    <span>Tổng</span>
                </div>

                <div class="bar-item">
                    <div class="bar-fill fill-green" style="height: <?= $finishedTours * 12 ?>px"></div>
                    <span>Hoàn thành</span>
                </div>

                <div class="bar-item">
                    <div class="bar-fill fill-orange" style="height: <?= $runningTours * 12 ?>px"></div>
                    <span>Đang diễn ra</span>
                </div>
            </div>
        </div>

    </div>

    
    <!-- ===== RECENT 5 TOURS ===== -->
<div class="history-card">
    <h3>📘 Lịch Sử Dẫn Tour </h3>

    <?php if (empty($historyTours)): ?>
        <p class="empty-text">Chưa có tour nào hoàn thành.</p>
    <?php else: ?>

    <table class="history-table">
        <tr>
            <th>Tên tour</th>
            <th>Bắt đầu</th>
            <th>Kết thúc</th>
            <th>Số khách</th>
            <th>Trạng thái</th>
        </tr>

        <?php foreach ($historyTours as $t): ?>
        <tr>
            <td><?= $t['tour_name'] ?></td>
            <td><?= date('d/m/Y', strtotime($t['start_date'])) ?></td>
            <td><?= date('d/m/Y', strtotime($t['end_date'])) ?></td>
            <td><?= $t['customer_count'] ?></td>
            <td><span class="status done">Hoàn thành</span></td>
        </tr>
        <?php endforeach; ?>

    </table>

    <?php endif; ?>

</div>
<div class="history-card">
    <h3>🚍 Tour Đang Diễn Ra</h3>

    <?php if (empty($runningToursList)): ?>
        <p class="empty-text">Hiện không có tour nào đang diễn ra.</p>
    <?php else: ?>
    
    <table class="history-table">
        <tr>
            <th>Tên tour</th>
            <th>Bắt đầu</th>
            <th>Kết thúc</th>
            <th>Số khách</th>
            <th>Trạng thái</th>
        </tr>

        <?php foreach ($runningToursList as $t): ?>
        <tr>
            <td><?= $t['tour_name'] ?></td>
            <td><?= date('d/m/Y', strtotime($t['start_date'])) ?></td>
            <td><?= date('d/m/Y', strtotime($t['end_date'])) ?></td>
            <td><?= $t['customer_count'] ?></td>
            <td><span class="status processing">Đang diễn ra</span></td>
        </tr>
        <?php endforeach; ?>

    </table>

    <?php endif; ?>
</div>



