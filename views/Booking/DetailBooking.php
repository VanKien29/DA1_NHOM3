<div class="main-content p-4">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold">Chi Tiết Booking #<?= $booking['booking_id'] ?></h3>
        <a href="?action=admin-listBooking" class="btn btn-secondary" style="text-decoration:none">← Quay lại</a>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Thông Tin Booking</div>
        <div class="card-body">

            <p><strong>Mã Booking:</strong> <?= $booking['booking_id'] ?></p>
            <p><strong>Tour:</strong> <?= $booking['tour_name'] ?></p>
            <p><strong>Ngày tạo:</strong> <?= $booking['created_at'] ?></p>
            <p><strong>Ngày bắt đầu:</strong> <?= $booking['start_date'] ?></p>

            <p><strong>Trạng thái:</strong>
                <?php if ($booking['status'] == 'cho_duyet'): ?>
                <span class="badge bg-warning text-dark">Chờ duyệt</span>
                <?php elseif ($booking['status'] == 'dang_dien_ra'): ?>
                <span class="badge bg-success">Đang diễn ra</span>
                <?php elseif ($booking['status'] == 'da_hoan_thanh'): ?>
                <span class="badge bg-primary">Đã hoàn thành</span>
                <?php elseif ($booking['status'] == 'da_huy'): ?>
                <span class="badge bg-danger">Đã hủy</span>
                <?php endif; ?>
            </p>

            <p><strong>Ghi chú:</strong><br>
                <?= $booking['report'] == null ? '—' : $booking['report']; ?>
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Hướng Dẫn Viên Phụ Trách</div>
        <div class="card-body">
            <?php if ($guide): ?>
            <p><strong>Họ tên:</strong> <?= $guide['guide_name'] ?></p>
            <p><strong>Email:</strong> <?= $guide['email'] ?></p>
            <p><strong>SĐT:</strong> <?= $guide['phone'] ?></p>
            <p><strong>Chuyên môn:</strong> <?= $guide['specialization'] ?></p>
            <p><strong>Kinh nghiệm:</strong> <?= $guide['experience_years'] ?> năm</p>

            <p><strong>Ngày bắt đầu tour:</strong> <?= $guide['start_date'] ?></p>
            <p><strong>Ngày kết thúc tour:</strong> <?= $guide['end_date'] ?></p>

            <?php else: ?>
            <p class="text-danger">Chưa phân hướng dẫn viên cho tour này.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Danh Sách Khách</div>
        <div class="card-body">
            <button class="btn btn-addCustomer"
                onclick="document.getElementById('addCustomerForm').style.display='block'">
                + Thêm khách
            </button>
            <?php if (count($customers) > 0): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $c): ?>
                    <tr>
                        <td><?= $c['customer_id'] ?></td>
                        <td><?= $c['full_name'] ?></td>
                        <td><?= $c['email'] ?></td>
                        <td><?= $c['phone'] ?></td>
                        <td class="action-col">
                            <a href="?action=admin-deleteCustomerBooking&id=<?= $c['bc_id'] ?>&booking_id=<?= $booking['booking_id'] ?>"
                                class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa khách này?')">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (!empty($_SESSION['message'])): ?>
            <div class="alert alert-success fade-alert"><?= $_SESSION['message']; ?></div>
            <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
            <p class=" fw-bold mt-3">Tổng số khách: <?= count($customers) ?> người</p>
            <?php else: ?>
            <p class="text-muted">Chưa thêm khách nào cho booking này.</p>
            <?php endif; ?>

            <div id="addCustomerForm" style="display:none;" class="border rounded p-3 mb-3 bg-light">
                <form method="POST">
                    <input type="hidden" name="action_add_customer" value="1">
                    <label class="fw-semibold">Chọn khách để thêm: </label>
                    <select name="add_customer_id" class="form-select mb-3">
                        <option value="">-- Chọn khách --</option>
                        <?php foreach ($customers_all as $c): ?>
                        <option value="<?= $c['customer_id'] ?>">
                            <?= $c['customer_id']?> -
                            <?= $c['full_name'] ?> - <?= $c['phone'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-secondary">Lưu khách</button>
                    <button type="button" class="btn btn-exitCustomer"
                        onclick="document.getElementById('addCustomerForm').style.display='none'">Hủy</button>
                </form>
            </div>
        </div>
        <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success fade-alert"><?= $_SESSION['message']; ?></div>
        <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-success fade-alert"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Tình Trạng Điểm Danh</div>
        <div class="card-body">

            <?php if (count($attendance) > 0): ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendance as $a): ?>
                    <tr>
                        <td><?= $a['full_name'] ?></td>
                        <td>
                            <?php if ($a['status'] == 'present'): ?>
                            <span class="badge bg-success">Có mặt</span>
                            <?php else: ?>
                            <span class="badge bg-danger">Vắng</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $a['note'] ?: '—' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="fw-bold mt-3">
                Có mặt: <?= count(array_filter($attendance, fn($x) => $x['status'] == 'present')) ?> /
                <?= count($attendance) ?> khách
            </p>

            <?php else: ?>
            <p class="text-muted">Chưa có dữ liệu điểm danh.</p>
            <?php endif; ?>

        </div>
    </div>

</div>