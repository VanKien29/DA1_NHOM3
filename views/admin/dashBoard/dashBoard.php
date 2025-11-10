<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/admin.css">
    <?php
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'admin-listTours':
                echo '<link rel="stylesheet" href="./assets/css/Tour/listTour.css">';
                break;
            case 'admin-listUsers':
                echo '<link rel="stylesheet" href="/assets/css/users.css">';
                break;
            case 'admin-listBookings':
                echo '<link rel="stylesheet" href="/assets/css/bookings.css">';
                break;
        }
    }
  ?>
</head>

<body>
    <div class="wrapper d-flex">
        <aside class="sidebar text-white p-3">
            <div class="sidebar-header text-center mb-4">
                <h4 class="fw-bold mb-0">AdminDek</h4>
                <p class="small text-secondary mb-0">Tour Dashboard</p>
            </div>

            <ul class="nav flex-column">
                <li><a href="?action=admin-dashboard" class="nav-link"><i
                            class="ri-dashboard-line me-2"></i>Dashboard</a></li>
                <li><a href="?action=admin-listUsers" class="nav-link"><i class="ri-user-line me-2"></i>Users</a></li>
                <li><a href="?action=admin-listTours" class="nav-link"><i class="ri-map-pin-line me-2"></i>Tours</a>
                </li>
                <li><a href="?action=admin-listBookings" class="nav-link"><i
                            class="ri-calendar-event-line me-2"></i>Bookings</a></li>
                <li><a href="?action=admin-listReports" class="nav-link"><i
                            class="ri-bar-chart-2-line me-2"></i>Reports</a>
                </li>
                <li><a href="?action=admin-listSuppliers" class="nav-link"><i
                            class="ri-hotel-line me-2"></i>Suppliers</a></li>
            </ul>
        </aside>
        <main class="main flex-grow-1">
            <header class="header bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <i class="ri-search-line text-muted fs-5"></i>
                    <input type="text" class="form-control form-control-sm" placeholder="Search..."
                        style="width: 200px;">
                </div>

                <div class="d-flex align-items-center gap-4">
                    <div class="notif-icons d-flex gap-3">
                        <span class="position-relative">
                            <i class="ri-notification-3-line fs-5"></i>
                            <span
                                class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle"></span>
                        </span>
                        <span><i class="ri-chat-1-line fs-5"></i></span>
                    </div>
                    <div class="user d-flex align-items-center">
                        <img src="https://i.pravatar.cc/40" alt="User" class="rounded-circle me-2">
                        <span class="fw-semibold">John Doe</span>
                    </div>
                </div>
            </header>
            <section class="content p-4">