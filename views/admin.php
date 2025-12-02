<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if (!isset($_SESSION['user'])) {
    header("Location: ?action=login");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travel Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <?php
    switch ($action) {
        // Tours
        case 'admin-listTours':
        case 'admin-searchTours':
            echo '<link rel="stylesheet" href="assets/css/Tour/listTours.css">';
            break;
        case 'admin-createTours':
        case 'admin-updateTours':
            echo '<link rel="stylesheet" href="assets/css/Tour/formTours.css">';
            break;
        // Users
        case 'admin-listUsers':
        case 'admin-searchUsers':
            echo '<link rel="stylesheet" href="assets/css/User/listUsers.css">';
            break;
        case 'admin-createUsers':
        case 'admin-updateUsers':
            echo '<link rel="stylesheet" href="assets/css/User/formUsers.css">';
            break;

        // Categories
        case 'admin-listCategory':
            echo '<link rel="stylesheet" href="assets/css/Category/listCategory.css">';
            break;
        case 'admin-createCategory':
        case 'admin-updateCategory':
            echo '<link rel="stylesheet" href="assets/css/Category/formCategory.css">';
            break;

        // Customers
        case 'admin-listCustomer':
        case 'admin-searchCustomer';
            echo '<link rel="stylesheet" href="assets/css/Customer/listCustomer.css">';
            break;
        case 'admin-createCustomer':
        case 'admin-updateCustomer':
            echo '<link rel="stylesheet" href="assets/css/Customer/formCustomer.css">';
            break;

        // Guides
        case 'admin-listGuide':
        case 'admin-searchGuide':
            echo '<link rel="stylesheet" href="assets/css/Guide/listGuide.css">';
            break;
        case 'admin-detailGuide':
            echo '<link rel="stylesheet" href="assets/css/Guide/detailGuide.css">';
            break;
        case 'admin-createGuide':
        case 'admin-updateGuide':
            echo '<link rel="stylesheet" href="assets/css/Guide/formGuide.css">';
            break;

        // Hotel
        case 'admin-listVehicles':
            echo '<link rel="stylesheet" href="assets/css/Vehicles/listVehicles.css">';
            break;
        case 'admin-createVehicles':
        case 'admin-updateVehicles':
            echo '<link rel="stylesheet" href="assets/css/Vehicles/formVehicles.css">';
            break;

        // Hotel
        case 'admin-listHotel':
            echo '<link rel="stylesheet" href="assets/css/Hotel/listHotel.css">';
            break;
        case 'admin-createHotel':
        case 'admin-updateHotel':
            echo '<link rel="stylesheet" href="assets/css/Hotel/formHotel.css">';
            break;

        // Reports
        case 'admin-listReport':
            echo '<link rel="stylesheet" href="assets/css/Report/listReport.css">';
            break;
        case 'admin-createReport':
        case 'admin-updateReport':
            echo '<link rel="stylesheet" href="assets/css/Report/formReport.css">';
            break;

        // Bookings
        case 'admin-listBooking':
            echo '<link rel="stylesheet" href="assets/css/Booking/listBooking.css">';
            break;
        case 'admin-detailBooking':
        case 'admin-deleteCustomerBooking':
            echo '<link rel="stylesheet" href="assets/css/Booking/detailBooking.css">';
            break;
        case 'admin-createBooking':
        case 'admin-updateBooking':
            echo '<link rel="stylesheet" href="assets/css/Booking/formBooking.css">';
            break;

        // HDV
        //
        case 'guide-schedule':
            echo '<link rel="stylesheet" href="assets/css/Guides/scheduleGuides.css">';
            break;
        case 'guide-detailGuideBooking':
        case 'guide-updateAttendance':
            echo '<link rel="stylesheet" href="assets/css/Guides/detailGuideBooking.css">';
            break;


    }
    ?>
</head>

<body>
    <aside class="sidebar">
        <h2>Tour Manager</h2>
        <?php if ($_SESSION['user']['role'] == "admin") { ?>
        <nav>
            <ul>
                <li>
                    <a href="?action=admin" class="<?= ($action == 'admin') ? 'active' : '' ?>">
                        <i class="fa-solid fa-suitcase-rolling"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listTours"
                        class="<?= ($action == 'admin-listTours' || $action == 'admin-createTour' || $action == 'admin-updateTour') ? 'active' : '' ?>">
                        <i class="fa-solid fa-suitcase-rolling"></i> Danh Sách Tour
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listBooking"
                        class="<?= ($action == 'admin-listBooking' || $action == 'admin-createBooking' || $action == 'admin-updateBooking' || $action == 'admin-detailBooking') ? 'active' : '' ?>">
                        <i class="fa-solid fa-calendar-check"></i> Đặt Tour
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listCustomer"
                        class="<?= ($action == 'admin-listCustomer' || $action == 'admin-createCustomer' || $action == 'admin-updateCustomer') ? 'active' : '' ?>">
                        <i class="fa-solid fa-users"></i> Khách Hàng
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listUsers"
                        class="<?= ($action == 'admin-listUsers' || $action == 'admin-createUser' || $action == 'admin-updateUser') ? 'active' : '' ?>">
                        <i class="fa-solid fa-user-tie"></i> Quản Trị Viên
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listCategory"
                        class="<?= ($action == 'admin-listCategory' || $action == 'admin-createCategory' || $action == 'admin-updateCategory') ? 'active' : '' ?>">
                        <i class="fa-solid fa-coins"></i> Danh Mục
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listGuide"
                        class="<?= ($action == 'admin-listGuide' || $action == 'admin-createGuide' || $action == 'admin-updateGuide' || $action == 'admin-detailGuide') ? 'active' : '' ?>">
                        <i class="fa-solid fa-coins"></i> Hướng Dẫn Viên
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listReport"
                        class="<?= ($action == 'admin-listReport' || $action == 'admin-createReport' || $action == 'admin-updateReport') ? 'active' : '' ?>">
                        <i class="fa-solid fa-file-lines"></i>
                        Báo Cáo HDV
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listVehicles"
                        class="<?= ($action == 'admin-listVehicles' || $action == 'admin-createVehicles' || $action == 'admin-updateVehicles') ? 'active' : '' ?>">
                        <i class="fa-solid fa-bus-simple"></i> Phương Tiện
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listHotel"
                        class="<?= ($action == 'admin-listHotel' || $action == 'admin-createHotel' || $action == 'admin-updateHotel') ? 'active' : '' ?>">
                        <i class="fa-solid fa-truck-field"></i> Khách Sạn
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-comments"></i> Đánh Giá
                    </a>
                </li>
            </ul>
        </nav>
        <?php } else { ?>
        <nav>
            <ul>
                <li>
                    <a href="?action=guide-schedule" class="<?= ($action == 'guide-schedule') ? 'active' : '' ?>">
                        <i class="fa-solid fa-calendar"></i> Lịch Tour
                    </a>
                </li>
            </ul>
        </nav>
        <?php } ?>
        <div class="sidebar-footer">
            <p><?= $user['name'] ?></p>
            <small><?= $user['role'] == "admin" ? "Quản Trị Viên" : "Hướng Dẫn Viên" ?></small>
            <div class="auth-buttons">
                <?php if (empty($user)) { ?>
                <a href="?action=login"><i class="fa-solid fa-right-to-bracket"></i> Đăng nhập</a>
                <?php } else { ?>
                <a href="?action=logout"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                <?php } ?>
            </div>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <form method="GET" style="width: 300px;">
                <input type="hidden" name="action" value="<?= str_replace('list', 'search', $action) ?>">

                <div class="searchbar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="keyword" placeholder="Search..." />
                </div>
            </form>
            <div class="topbar-right">
                <button class="tb-btn" aria-label="Notifications">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="20" viewBox="0 0 24 24"
                        width="20">
                        <path
                            d="M12 22c1.1046 0 2-.8954 2-2h-4c0 1.1046.8954 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" />
                    </svg>
                    <span class="dot"></span>
                </button>

                <button class="tb-btn" aria-label="Messages">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="20" viewBox="0 0 24 24"
                        width="20">
                        <path d="M21 6h-18v12h18v-12zm-9 7h-3v-2h3v2zm6-4h-3v-2h3v2zm0 3h-6v-2h6v2z" />
                    </svg>
                </button>

                <div class="tb-user" tabindex="0">
                    <span><?= $user['name'] ?></span>
                </div>
            </div>
        </header>
        <div id="main-content" class="p-3">
            <?php if ($_SESSION['user']['role'] == "guide") {
                switch ($action) {
                    case 'guide-schedule':
                        (new GuideScheduleController)->mySchedule();
                        break;
                    case 'guide-detailGuideBooking':
                        (new GuideScheduleController)->detailGuideBooking($id);
                        break;
                    case 'guide-updateAttendance':
                        (new GuideScheduleController)->updateAttendance();
                        break;
                }
                return;
            } else {
                switch ($action) {
                    // Tours
                    case 'admin-listTours':
                        (new TourController)->listTours();
                        break;
                    case 'admin-createTours':
                        (new TourController)->createTours();
                        break;
                    case 'admin-updateTours':
                        (new TourController)->updateTours($id);
                        break;
                    case 'admin-deleteTours':
                        (new TourController)->deleteTours($id);
                        break;
                    case 'admin-searchTours':
                        (new TourController)->searchTours($id);
                        break;

                    // Users
                    case 'admin-listUsers':
                        (new UsersController)->listUsers();
                        break;
                    case 'admin-createUsers':
                        (new UsersController)->createUsers();
                        break;
                    case 'admin-updateUsers':
                        (new UsersController)->updateUsers($id);
                        break;
                    case 'admin-deleteUsers':
                        (new UsersController)->deleteUsers($id);
                        break;
                    case 'admin-searchUsers':
                        (new UsersController)->searchUsers($id);
                        break;

                    // Categories
                    case 'admin-listCategory':
                        (new CategoryController)->listCategories();
                        break;
                    case 'admin-createCategory':
                        (new CategoryController)->createCategory();
                        break;
                    case 'admin-updateCategory':
                        (new CategoryController)->updateCategory($id);
                        break;
                    case 'admin-deleteCategory':
                        (new CategoryController)->deleteCategory($id);
                        break;

                    // Customers
                    case 'admin-listCustomer':
                        (new CustomerController)->listCustomers();
                        break;
                    case 'admin-createCustomer':
                        (new CustomerController)->createCustomer();
                        break;
                    case 'admin-updateCustomer':
                        (new CustomerController)->updateCustomer($id);
                        break;
                    case 'admin-deleteCustomer':
                        (new CustomerController)->deleteCustomer($id);
                        break;
                    case 'admin-searchCustomer':
                        (new CustomerController)->searchCustomer($id);
                        break;

                    // hotel
                    case 'admin-listHotel':
                        (new HotelController)->listHotel();
                        break;
                    case 'admin-createHotel':
                        (new HotelController)->createHotel();
                        break;
                    case 'admin-updateHotel':
                        (new HotelController)->updateHotel();
                        break;
                    case 'admin-deleteHotel':
                        (new HotelController)->deleteHotel();
                        break;

                    // vehicles
                    case 'admin-listVehicles':
                        (new VehiclesController)->listVehicles();
                        break;
                    case 'admin-createVehicles':
                        (new VehiclesController)->createVehicles();
                        break;
                    case 'admin-updateVehicles':
                        (new VehiclesController)->updateVehicles();
                        break;
                    case 'admin-deleteVehicles':
                        (new VehiclesController)->deleteVehicles();
                        break;

                    // Guides 
                    case 'admin-listGuide':
                        (new GuideController)->listGuide();
                        break;
                    case 'admin-createGuide':
                        (new GuideController)->createGuide();
                        break;
                    case 'admin-updateGuide':
                        (new GuideController)->updateGuide($id);
                        break;
                    case 'admin-deleteGuide':
                        (new GuideController)->deleteGuide($id);
                        break;
                    case 'admin-detailGuide':
                        (new GuideController)->detailGuide($id);
                        break;
                    case 'admin-searchGuide':
                        (new GuideController)->searchGuide($id);
                        break;

                    // Reports
                    case 'admin-listReport':
                        (new ReportController)->listReports();
                        break;
                    case 'admin-createReport':
                        (new ReportController)->createReport();
                        break;
                    case 'admin-updateReport':
                        (new ReportController)->updateReport($id);
                        break;
                    case 'admin-deleteReport':
                        (new ReportController)->deleteReport($id);
                        break;

                    // Bookings
                    case 'admin-listBooking':
                        (new BookingController)->listBooking();
                        break;
                    case 'admin-detailBooking':
                        (new BookingController)->detailBooking($id);
                        break;
                    case 'admin-createBooking':
                        (new BookingController)->createBooking();
                        break;
                    case 'admin-updateBooking':
                        (new BookingController)->updateBooking($id);
                        break;
                    case 'admin-deleteBooking':
                        (new BookingController)->deleteBooking($id);
                        break;
                    case 'admin-deleteCustomerBooking':
                        (new BookingController)->deleteCustomer($id, $_GET['booking_id']);
                        break;
                    case 'admin-chooseRooms':
                        (new BookingController)->chooseRooms();
                        break;
                }
            }
            ?>
        </div>
    </main>
</body>

</html>