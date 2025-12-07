<style>
/* ========== DASHBOARD WRAPPER ========== */
.dashboard-wrapper {
    padding: 20px 28px;
    font-family: "Segoe UI", sans-serif;
    background: #f4f7fc;
}

/* ========== HEADER ========== */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 22px;
}

.dashboard-header h1 {
    font-size: 26px;
    font-weight: 700;
    color: #1e2a3a;
}

.year-select {
    padding: 6px 12px;
    border-radius: 6px;
    border: 1px solid #ced6e0;
    background: #fff;
    font-size: 14px;
}

/* ========== STAT CARDS GRID ========== */
.card-grid {
    display: grid;
    gap: 16px;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    margin-bottom: 22px;
}

.stat-card {
    background: #ffffff;
    padding: 20px;
    border-radius: 14px;
    border: 1px solid #e6ebf2;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    transition: .2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.stat-card h3 {
    font-size: 13px;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #7c8a97;
}

.stat-card .value {
    margin-top: 10px;
    font-size: 26px;
    font-weight: 700;
    color: #1f2937;
}

/* DOANH THU */
.stat-card.revenue {
    background: linear-gradient(135deg, #4fa3ff, #76baff);
    border: none;
    color: #fff;
}

.stat-card.revenue h3 {
    color: rgba(255, 255, 255, 0.85);
}

.stat-card.revenue .value {
    color: #ffffff;
}


/* ========== CHART GRID ========== */
.chart-section {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
}

.chart-box {
    background: white;
    padding: 18px 20px;
    border-radius: 14px;
    border: 1px solid #e4e8ef;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

.chart-box h3 {
    font-size: 17px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #1e293b;
}

/* ========== TABLE WRAPPER ========== */
.table-section {
    margin-top: 30px;
}

.table-section h3 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #1e293b;
}

.stat-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e6ebf2;
}

.stat-table thead {
    background: #f1f4f9;
}

.stat-table th {
    text-align: left;
    font-size: 14px;
    padding: 12px 14px;
    color: #475569;
    font-weight: 600;
}

.stat-table td {
    padding: 12px 14px;
    font-size: 15px;
    color: #334155;
    border-top: 1px solid #eef2f6;
}

.stat-table tr:hover td {
    background: #f8fbff;
}

/* ========== RESPONSIVE FIX ========== */
@media(max-width: 768px) {
    .chart-section {
        grid-template-columns: 1fr;
    }
}
</style>


<div class="dashboard-wrapper">

    <div class="dashboard-header">
        <h1>📊 Dashboard Thống Kê</h1>

        <!-- Chọn năm -->
        <form method="GET">
            <input type="hidden" name="action" value="admin-statistic">
            <select name="year" class="year-select" onchange="this.form.submit()">
                <?php 
                    $current = date("Y"); 
                    for ($y = $current; $y >= $current - 5; $y--): 
                ?>
                <option value="<?= $y ?>" <?= ($data['year'] == $y ? 'selected' : '') ?>>
                    <?= $y ?>
                </option>
                <?php endfor; ?>
            </select>
        </form>
    </div>


    <!-- STAT CARDS -->
    <div class="card-grid">

        <div class="stat-card">
            <h3>Tổng Tour</h3>
            <div class="value"><?= $data['total_tours'] ?></div>
        </div>

        <div class="stat-card">
            <h3>Tổng Booking</h3>
            <div class="value"><?= $data['total_bookings'] ?></div>
        </div>

        <div class="stat-card">
            <h3>Tổng Khách hàng</h3>
            <div class="value"><?= $data['total_customers'] ?></div>
        </div>

        <div class="stat-card">
            <h3>Tổng Hướng Dẫn Viên</h3>
            <div class="value"><?= $data['total_guides'] ?></div>
        </div>

        <div class="stat-card revenue">
            <h3>Tổng Doanh Thu</h3>
            <div class="value"><?= number_format($data['total_revenue']) ?> VND</div>
        </div>

    </div>


    <!-- CHARTS -->
    <div class="chart-section">

        <div class="chart-box">
            <h3>📈 Booking Theo Tháng</h3>
            <canvas id="chartBooking"></canvas>
        </div>

        <div class="chart-box">
            <h3>💰 Doanh Thu Theo Tháng</h3>
            <canvas id="chartRevenue"></canvas>
        </div>

    </div>



    <!-- TABLE STATISTICS -->
    <div class="table-section">

        <h3>🔥 Top 5 Tour Bán Chạy</h3>

        <table class="stat-table">
            <thead>
                <tr>
                    <th>Tour</th>
                    <th>Lượt Booking</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['top_tours'] as $t): ?>
                <tr>
                    <td><?= $t['tour_name'] ?></td>
                    <td><?= $t['total'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <h3 style="margin-top:30px;">⭐ Top 5 Hướng Dẫn Viên</h3>

        <table class="stat-table">
            <thead>
                <tr>
                    <th>Hướng Dẫn Viên</th>
                    <th>Số Tour Dẫn</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['top_guides'] as $g): ?>
                <tr>
                    <td><?= $g['guide_name'] ?></td>
                    <td><?= $g['total'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const bookingData = <?= json_encode($data['booking_month']) ?>;
const revenueData = <?= json_encode($data['revenue_month']) ?>;

// Format data
const bookingLabels = bookingData.map(x => "Tháng " + x.month);
const bookingValues = bookingData.map(x => x.total);

const revenueLabels = revenueData.map(x => "Tháng " + x.month);
const revenueValues = revenueData.map(x => x.revenue);


// Booking chart
new Chart(document.getElementById("chartBooking"), {
    type: "bar",
    data: {
        labels: bookingLabels,
        datasets: [{
            label: "Booking",
            data: bookingValues,
            backgroundColor: "#3b82f6",
            borderRadius: 6
        }]
    }
});

// Revenue Chart
new Chart(document.getElementById("chartRevenue"), {
    type: "line",
    data: {
        labels: revenueLabels,
        datasets: [{
            label: "Doanh thu",
            data: revenueValues,
            borderColor: "#16a34a",
            backgroundColor: "rgba(22,163,74,0.3)",
            borderWidth: 3,
            tension: 0.4
        }]
    }
});
</script>