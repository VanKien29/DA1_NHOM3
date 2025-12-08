<?php $this->bookingQuery->updateAutoStatus();?>
<div class="main-content p-4">
    <div class="table-container">
        <div class="admin-table-container">
            <div class="table-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Danh Sách Booking</h4>
                <a href="?action=admin-createBooking" class="btn btn-primary">
                    + Thêm Booking
                </a>
            </div>
            <div class="filter-bar mb-3">
                <form method="GET" class="filter-form d-flex gap-2 align-items-center">
                    <input type="hidden" name="action" value="admin-listBooking">

                    <!-- Lọc trạng thái -->
                    <select name="status" class="filter-input">
                        <option value="">Trạng thái</option>
                        <option value="sap_dien_ra"
                            <?= (isset($_GET['status']) && $_GET['status'] == 'sap_dien_ra') ? 'selected' : '' ?>>
                            Sắp diễn ra
                        </option>
                        <option value="dang_dien_ra"
                            <?= (isset($_GET['status']) && $_GET['status'] == 'dang_dien_ra') ? 'selected' : '' ?>>
                            Đang diễn ra
                        </option>
                        <option value="cho_xac_nhan_ket_thuc"
                            <?= (isset($_GET['status']) && $_GET['status'] == 'cho_xac_nhan_ket_thuc') ? 'selected' : '' ?>>
                            Chờ xác nhận
                        </option>
                        <option value="da_hoan_thanh"
                            <?= (isset($_GET['status']) && $_GET['status'] == 'da_hoan_thanh') ? 'selected' : '' ?>>
                            Đã hoàn thành
                        </option>
                        <option value="da_huy"
                            <?= (isset($_GET['status']) && $_GET['status'] == 'da_huy') ? 'selected' : '' ?>>
                            Đã hủy
                        </option>
                    </select>

                    <!-- Lọc ngày -->
                    <input type="date" name="from" class="filter-input" value="<?= $_GET['from'] ?? '' ?>">
                    <input type="date" name="to" class="filter-input" value="<?= $_GET['to'] ?? '' ?>">
                    <button class="btn btn-primary filter-btn">Lọc</button>
                    <?php if (!empty($_GET['status']) || !empty($_GET['from']) || !empty($_GET['to'])): ?>
                    <a href="?action=admin-listBooking" class="btn btn-secondary filter-reset">Xóa lọc</a>
                    <?php endif; ?>
                </form>
            </div>

            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tour</th>
                        <!-- <th>Khách sạn</th>
                        <th>Phương tiện</th> -->
                        <th>HDV phụ trách</th>
                        <th>Số khách</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Ngày/Đêm</th>
                        <th>Tổng giá</th>
                        <th>Trạng thái</th>
                        <th style="text-align: center;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; foreach ($bookings as $b): 
                        $start = strtotime($b['start_date']);
                        $end   = strtotime($b['end_date']);
                        $total_days  = ($end - $start) / 86400 + 1;
                        $total_nights = $total_days - 1;   
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= htmlspecialchars($b['tour_name']); ?></td>
                        <!-- <td><?= htmlspecialchars($b['hotel_name']); ?></td>
                        <td><?= htmlspecialchars($b['vehicle_name']); ?></td> -->
                        <td><?= htmlspecialchars($b['guide_name']); ?></td>
                        <td><?= htmlspecialchars($b['total_customers']); ?></td>
                        <td><?= date('d/m/Y', strtotime($b['start_date'])); ?></td>
                        <td><?= empty($b['end_date']) ? '' : date('d/m/Y', strtotime($b['end_date'])); ?></td>
                        <td style="text-align: center"><?= $total_days ?> ngày
                            <?= $total_nights == 0 ? "" : " / " . $total_nights . " đêm" ?></td>
                        <td><?= number_format($b['total_price']) . ' VND'?></td>
                        <td>
                            <?php if ($b['status'] == 'sap_dien_ra'): ?>
                            <span class="badge badge-warning-soft">Sắp diễn ra</span>
                            <?php elseif ($b['status'] == 'dang_dien_ra'): ?>
                            <span class="badge badge-success-soft">Đang diễn ra</span>
                            <?php elseif ($b['status'] == 'cho_xac_nhan_ket_thuc'): ?>
                            <span class="badge badge-info-soft">Chờ xác nhận</span>
                            <?php elseif ($b['status'] == 'da_hoan_thanh'): ?>
                            <span class="badge badge-primary-soft">Đã hoàn thành</span>
                            <?php elseif ($b['status'] == 'da_huy'): ?>
                            <span class="badge badge-danger-soft">Đã hủy</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="?action=admin-detailBooking&id=<?= $b['booking_id']; ?>"
                                class="btn btn-sm btn-outline-detail">Chi tiết</a>
                            <a href="?action=admin-updateBooking&id=<?= $b['booking_id']; ?>"
                                class="btn btn-sm btn-outline-success">Sửa</a>
                            <a href="?action=admin-deleteBooking&id=<?= $b['booking_id']; ?>"
                                onclick="return confirm('Xác nhận xóa booking này?')"
                                class="btn btn-sm btn-outline-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>