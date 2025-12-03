<div class="stats-wrapper">

    <h2 class="page-title">
        <i class="fa-solid fa-chart-line"></i> Thống Kê Hoạt Động Hướng Dẫn Viên
    </h2>

    <!-- OVERVIEW CARDS -->
    <div class="overview-grid">

        <div class="overview-box box-blue">
            <i class="fa-solid fa-route"></i>
            <div>
                <h3><?= $totalTours ?></h3>
                <p>Tổng số tour đã dẫn</p>
            </div>
        </div>

        <div class="overview-box box-green">
            <i class="fa-solid fa-check-circle"></i>
            <div>
                <h3><?= $finishedTours ?></h3>
                <p>Tour đã hoàn thành</p>
            </div>
        </div>

        <div class="overview-box box-orange">
            <i class="fa-solid fa-hourglass-half"></i>
            <div>
                <h3><?= $runningTours ?></h3>
                <p>Tour đang diễn ra</p>
            </div>
        </div>

        <div class="overview-box box-purple">
            <i class="fa-solid fa-users"></i>
            <div>
                <h3><?= $totalCustomers ?></h3>
                <p>Tổng khách đã phục vụ</p>
            </div>
        </div>

    </div>

    <!-- PROGRESS SECTION -->
    <div class="card">
        <h3><i class="fa-solid fa-chart-simple"></i> Mức độ hoạt động</h3>

        <p>Tỷ lệ tour hoàn thành</p>
        <?php 
            $percent = $totalTours > 0 ? round(($finishedTours / $totalTours) * 100) : 0;
        ?>
        <div class="progress-bar">
            <div class="progress" style="width: <?= $percent ?>%"></div>
        </div>
        <span class="progress-text"><?= $percent ?>%</span>
    </div>

    <!-- CHART SECTION -->
    <div class="card">
        <h3><i class="fa-solid fa-chart-column"></i> Biểu đồ số tour</h3>

        <div class="chart">
            <div class="bar">
                <div class="bar-fill blue" style="height: <?= $totalTours * 15 ?>px"></div>
                <span>Tổng</span>
            </div>

            <div class="bar">
                <div class="bar-fill green" style="height: <?= $finishedTours * 15 ?>px"></div>
                <span>Hoàn thành</span>
            </div>

            <div class="bar">
                <div class="bar-fill orange" style="height: <?= $runningTours * 15 ?>px"></div>
                <span>Đang diễn ra</span>
            </div>
        </div>
    </div>

</div>
