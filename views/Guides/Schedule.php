<div class="admin-table-container">
    <h3 class="fw-bold mb-3">Lịch Tour của Tôi</h3>

    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tour</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Khách</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php $i=1; foreach($schedule as $item): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $item['tour_name'] ?></td>
                <td><?= $item['start_date'] ?></td>
                <td><?= $item['end_date'] ?></td>
                <td>
                    <?php
                        switch($item['status']) {
                            case 'dang_dien_ra':
                                echo "<span class='badge bg-success'>Đang diễn ra</span>";
                                break;
                            case 'cho_duyet':
                                echo "<span class='badge bg-warning'>Chờ duyệt</span>";
                                break;
                            case 'da_hoan_thanh':
                                echo "<span class='badge bg-primary'>Đã hoàn thành</span>";
                                break;
                            case 'da_huy':
                                echo "<span class='badge bg-danger'>Đã hủy</span>";
                                break;
                        }
                    ?>
                </td>
                <td><?= $item['total_customers'] ?></td>

                <td>
                    <a href="?action=guide-detaillBooking&id=<?= $item['booking_id'] ?>"
                       class="btn btn-sm btn-primary">
                        Xem chi tiết
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
