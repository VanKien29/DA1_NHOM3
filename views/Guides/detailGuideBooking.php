<div class="main-content">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold">Chi Tiết Tour – Booking #<?= $booking['booking_id'] ?></h3>
        <a href="?action=guide-schedule" class="btn btn-secondary">← Quay lại</a>
    </div>

    <div class="booking-layout">
        <div class="left-column">
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông Tin Tour</div>
                <div class="card-body">
                    <p><strong>Mã Booking:</strong> <?= $booking['booking_id'] ?></p>
                    <p><strong>Tour:</strong> <?= $booking['tour_name'] ?></p>
                    <p><strong>Ngày bắt đầu:</strong> <?= $booking['start_date'] ?></p>
                    <p><strong>Ngày kết thúc:</strong> <?= $booking['end_date'] ?></p>

                    <div class="d-flex align-items-center gap-2 mb-2">
                        <strong>Trạng thái:</strong>
                        <span id="statusBadge">
                            <?php
                            switch ($booking['status']) {
                                case 'dang_dien_ra':
                                    echo "<span class='badge bg-success'>Đang diễn ra</span>";
                                    break;
                                case 'sap_dien_ra':
                                    echo "<span class='badge bg-warning text-dark'>Sắp diễn ra</span>";
                                    break;
                                case 'da_hoan_thanh':
                                    echo "<span class='badge bg-primary'>Đã hoàn thành</span>";
                                    break;
                                case 'cho_xac_nhan_ket_thuc':
                                    echo "<span class='badge bg-primary'>Chờ xác nhận</span>";
                                    break;
                                case 'da_huy':
                                    echo "<span class='badge bg-danger'>Đã huỷ</span>";
                                    break;
                            }
                            ?>
                        </span>
                        <?php if ($booking['status'] !== 'da_hoan_thanh'): ?>
                        <button class="btn btn-status" onclick="toggleStatusForm()">Cập nhật</button>
                        <?php endif; ?>

                        <?php if (!empty($_SESSION['msg'])): ?>
                        <div class="alert alert-danger fade-alert">
                            <?= $_SESSION['msg']; ?>
                        </div>
                        <?php unset($_SESSION['msg']); ?>
                        <?php endif; ?>

                        <?php if (!empty($_SESSION['message'])): ?>
                        <div class="alert alert-success fade-alert">
                            <?= $_SESSION['message']; ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>
                    </div>

                    <div id="statusForm" class="status-form d-none">
                        <form method="POST" action="?action=guide-updateStatusByGuide">
                            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">

                            <select name="status" class="form-select">
                                <option value="dang_dien_ra"
                                    <?= $booking['status'] == 'dang_dien_ra' ? 'selected' : '' ?>>
                                    Xác nhận đang diễn ra
                                </option>
                                <option value="da_hoan_thanh"
                                    <?= $booking['status'] == 'da_hoan_thanh' ? 'selected' : '' ?>>
                                    Xác nhận hoàn thành tour
                                </option>
                            </select>

                            <button class="btn btn-success mt-2">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>

            <br>

            <div class="card mb-4 note-card">
                <div class="card-header fw-bold">Ghi chú hướng dẫn viên</div>
                <div class="card-body">
                    <?php if ($booking['status'] !== 'da_hoan_thanh'): ?>
                    <form method="POST" action="?action=guide-updateNote">
                        <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                        <textarea name="note"><?= $booking['note'] ?></textarea>
                        <button class="btn btn-primary mt-2">Lưu ghi chú</button>
                    </form>
                    <?php else: ?>
                    <p><?= $booking['note'] ?: 'Không có ghi chú' ?></p>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['message'])): ?>
                    <div class="note-alert"><?= $_SESSION['message']; ?></div>
                    <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- ============= RIGHT COLUMN ============= -->
        <div class="right-column">
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông Tin Khách Sạn</div>
                <div class="card-body">
                    <p><strong>Tên khách sạn:</strong> <?= $booking['hotel_name'] ?></p>
                    <p><strong>Chủ khách sạn:</strong> <?= $booking['hotel_manager'] ?></p>
                    <p><strong>SĐT Chủ KS:</strong> <?= $booking['hotel_manager_phone'] ?></p>
                </div>
            </div>

            <br>

            <div class="card mb-4">
                <div class="card-header fw-bold">Phương Tiện Theo Lịch Trình</div>
                <div class="card-body">
                    <?php if (!empty($segments_grouped)): ?>
                    <?php foreach ($segments_grouped as $sid => $seg): ?>
                    <div class="segment-accordion">
                        <div class="segment-header" onclick="toggleSegment(<?= $sid ?>)">
                            <div>
                                <strong>Ngày <?= $seg['day_number'] ?></strong> – <?= $seg['title'] ?>
                            </div>
                            <div class="arrow" id="arrow-<?= $sid ?>">▼</div>
                        </div>

                        <div class="segment-content" id="segment-<?= $sid ?>">
                            <?php if ($seg['vehicle']): ?>
                            <p><strong>Xe sử dụng:</strong> <?= $seg['vehicle'] ?></p>
                            <p><strong>Giá chặng:</strong> <?= number_format($seg['price_per_day']) ?> VND</p>

                            <?php if (!empty($seg['using'])): ?>
                            <p><strong>Khách sử dụng xe:</strong></p>
                            <table class="segment-table">
                                <thead>
                                    <tr>
                                        <th>Khách hàng</th>
                                        <th>Giá theo chặng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($seg['using'] as $u): ?>
                                    <tr>
                                        <td><?= $u['full_name'] ?></td>
                                        <td><?= number_format($u['segment_price_per_customer']) ?> VND</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>

                            <?php if (!empty($seg['excluded'])): ?>
                            <p><strong>Khách không sử dụng xe:</strong></p>
                            <table class="segment-table">
                                <thead>
                                    <tr>
                                        <th>Khách hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($seg['excluded'] as $e): ?>
                                    <tr>
                                        <td><?= $e['full_name'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>

                            <?php else: ?>
                            <p class="text-muted">Chặng này không sử dụng phương tiện.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="text-muted">Không có dữ liệu phương tiện theo lịch trình.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <!-- ======================= LỊCH TRÌNH TOUR ======================= -->
    <div class="card mb-4">
        <div class="card-header fw-bold">Lịch Trình Tour</div>
        <div class="card-body">
            <?php if (!empty($schedules)): ?>
            <div class="schedule-wrapper">
                <?php foreach ($schedules as $sch): ?>
                <div class="schedule-item">
                    <div class="schedule-day">Ngày <?= $sch['day_number'] ?></div>
                    <div class="schedule-line"></div>

                    <div class="schedule-content">
                        <p class="schedule-title"><?= htmlspecialchars($sch['title']) ?></p>
                        <p class="schedule-desc"><?= nl2br(htmlspecialchars($sch['description'])) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p class="text-muted">Tour này chưa có lịch trình.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ======================= CHỌN NGÀY ĐIỂM DANH ======================= -->
    <div class="mb-3">
        <h5 class="fw-bold">Điểm danh theo ngày</h5>

        <div class="btn-group" role="group">
            <?php for ($d = 1; $d <= $booking['days']; $d++): ?>
            <a href="?action=guide-detailGuideBooking&id=<?= $booking['booking_id'] ?>&day=<?= $d ?>"
                class="btn <?= ($day == $d) ? 'btn-primary' : 'btn-outline-primary' ?>">
                Ngày <?= $d ?>
            </a>
            <?php endfor; ?>
        </div>
    </div>

    <!-- ======================= DANH SÁCH KHÁCH ======================= -->
    <div class="booking-info-box">
        <h5>Danh sách khách – Ngày <?= $day ?></h5>

        <table class="table-schedule">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên khách</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Điểm danh</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 1;
                $attMap = [];
                foreach ($attendance as $a)
                    $attMap[$a['customer_id']] = $a;
                ?>

                <?php foreach ($customers as $c):
                    $att = $attMap[$c['customer_id']] ?? null;
                    ?>
                <tr>
                    <td><?= $i++ ?></td>

                    <td>
                        <?= $c['full_name'] ?>
                        <?php if ($c['is_main']): ?>
                        <span class="badge bg-primary">Chính</span>
                        <?php endif; ?>
                    </td>

                    <td><?= $c['phone'] ?></td>
                    <td><?= $c['email'] ?></td>

                    <td>
                        <?php if ($booking['status'] === 'dang_dien_ra'): ?>

                        <?php if ($att): ?>
                        <!-- FORM ĐIỂM DANH -->
                        <form method="POST" action="?action=guide-updateAttendance" style="display:flex; gap:6px;">
                            <input type="hidden" name="attendance_id" value="<?= $att['id'] ?>">
                            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                            <input type="hidden" name="day_number" value="<?= $day ?>">

                            <button name="status" value="present"
                                class="btn <?= $att['status'] === 'present' ? 'btn-success' : 'btn-outline-success' ?>">
                                Có mặt
                            </button>

                            <button name="status" value="absent"
                                class="btn <?= $att['status'] === 'absent' ? 'btn-danger' : 'btn-outline-danger' ?>">
                                Vắng
                            </button>
                        </form>
                        <?php else: ?>
                        <span class="badge bg-secondary">Chưa có dữ liệu</span>
                        <?php endif; ?>

                        <?php else: ?>

                        <?php if ($att): ?>
                        <?php if ($att['status'] === 'present'): ?>
                        <span class="badge bg-success">Có mặt</span>
                        <?php elseif ($att['status'] === 'absent'): ?>
                        <span class="badge bg-danger">Vắng</span>
                        <?php endif; ?>
                        <?php else: ?>
                        <span class="badge bg-secondary">—</span>
                        <?php endif; ?>

                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
function toggleStatusForm() {
    document.getElementById("statusForm").classList.toggle("d-none");
}

function toggleSegment(id) {
    const box = document.getElementById("segment-" + id);
    const arrow = document.getElementById("arrow-" + id);

    if (box.classList.contains("open")) {
        box.classList.remove("open");
        arrow.innerHTML = "▼";
    } else {
        box.classList.add("open");
        arrow.innerHTML = "▲";
    }
}
</script>