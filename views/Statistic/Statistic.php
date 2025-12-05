<style>
body {
    background: #f4f6f9;
    font-family: "Segoe UI", sans-serif;
}

.dashboard-container {
    padding: 20px 40px;
}

h2.title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 25px;
    color: #333;
}

/* ====== STAT CARDS ====== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    transition: 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
}

.stat-card h4 {
    margin: 0;
    color: #666;
    font-size: 15px;
    font-weight: 500;
}

.stat-card .value {
    font-size: 28px;
    margin-top: 8px;
    font-weight: bold;
    color: #222;
}

.stat-card.revenue {
    background: linear-gradient(135deg, #3ac27e, #4be28b);
    color: white;
}

.stat-card.revenue h4 {
    color: white;
}

.stat-card.revenue .value {
    color: #fff;
}

/* ====== CHARTS ====== */
.charts-grid {
    margin-top: 30px;
    display: grid;
    gap: 25px;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
}

.chart-box {
    background: white;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

.chart-box h3 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #333;
    text-align: center;
}

/* ====== RANK LISTS ====== */
.rank-grid {
    margin-top: 30px;
    display: grid;
    gap: 25px;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
}

.rank-box {
    background: white;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

.rank-box h3 {
    margin-bottom: 15px;
    font-size: 18px;
    color: #333;
    text-align: center;
}

.rank-item {
    padding: 12px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    font-size: 16px;
}

.rank-item:last-child {
    border-bottom: none;
}

@media(max-width: 600px) {

    .charts-grid,
    .rank-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="dashboard-container">

    <h2 class="title">📊 Dashboard Thống Kê</h2>

    <!-- ======= STAT CARDS ======= -->
    <div class="stats-grid">

        <div class="stat-card">
            <h4>Tổng Tour</h4>
            <div class="value"><?= $data['total_tours'] ?></div>
        </div>

        <div class="stat-card">
            <h4>Tổng Booking</h4>
            <div class="value"><?= $data['total_bookings'] ?></div>
        </div>

        <div class="stat-card">
            <h4>Tổng Khách hàng</h4>
            <div class="value"><?= $data['total_customers'] ?></div>
        </div>

        <div class="stat-card">
            <h4>Tổng Hướng dẫn viên</h4>
            <div class="value"><?= $data['total_guides'] ?></div>
        </div>

        <div class="stat-card revenue">
            <h4>Tổng Doanh Thu</h4>
            <div class="value"><?= number_format($data['total_revenue']) ?> VND</div>
        </div>

    </div>

    <!-- ======= CHARTS ======= -->
    <div class="charts-grid">

        <div class="chart-box">
            <h3>📈 Booking Theo Tháng</h3>
            <canvas id="bookingChart"></canvas>
        </div>

        <div class="chart-box">
            <h3>💰 Doanh Thu Theo Tháng</h3>
            <canvas id="revenueChart"></canvas>
        </div>

    </div>

    <!-- ======= RANK LISTS ======= -->
    <div class="rank-grid">

        <div class="rank-box">
            <h3>🔥 Top 5 Tour Bán Chạy</h3>
            <?php foreach ($data['top_tours'] as $t): ?>
            <div class="rank-item">
                <span><?= $t['tour_name'] ?></span>
                <strong><?= $t['total'] ?> booking</strong>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="rank-box">
            <h3>⭐ Top 5 Hướng Dẫn Viên</h3>
            <?php foreach ($data['top_guides'] as $g): ?>
            <div class="rank-item">
                <span><?= $g['guide_name'] ?></span>
                <strong><?= $g['total'] ?> tour</strong>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>


<!-- ===== Chart.js ===== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Booking chart
const bookingLabels = <?= json_encode(array_column($data['booking_month'], 'month')) ?>;
const bookingData = <?= json_encode(array_column($data['booking_month'], 'total')) ?>;

new Chart(document.getElementById("bookingChart"), {
    type: "bar",
    data: {
        labels: bookingLabels,
        datasets: [{
            label: "Số booking",
            data: bookingData,
            backgroundColor: "#4e73df"
        }]
    }
});

// Revenue chart
const revenueLabels = <?= json_encode(array_column($data['revenue_month'], 'month')) ?>;
const revenueData = <?= json_encode(array_column($data['revenue_month'], 'revenue')) ?>;

new Chart(document.getElementById("revenueChart"), {
    type: "line",
    data: {
        labels: revenueLabels,
        datasets: [{
            label: "Doanh thu (VND)",
            data: revenueData,
            borderColor: "#1cc88a",
            borderWidth: 3,
            fill: false
        }]
    }
});
</script>