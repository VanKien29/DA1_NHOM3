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
            echo '<link rel="stylesheet" href="assets/css/Customer/listCustomer.css">';
            break;
        case 'admin-createCustomer':
        case 'admin-updateCustomer':
            echo '<link rel="stylesheet" href="assets/css/Customer/formCustomer.css">';
            break;

        // Discounts
        case 'admin-listDiscount':
            echo '<link rel="stylesheet" href="assets/css/Discount/listDiscount.css">';
            break;
        case 'admin-createDiscount':
        case 'admin-updateDiscount':
            echo '<link rel="stylesheet" href="assets/css/Discount/formDiscount.css">';
            break;

        // Guides
        case 'admin-listGuide':
            echo '<link rel="stylesheet" href="assets/css/Guide/listGuide.css">';
            break;
        case 'admin-createGuide':
        case 'admin-updateGuide':
            echo '<link rel="stylesheet" href="assets/css/Guide/formGuide.css">';
            break;

        // Tour Guides
        case 'admin-listTourGuide':
            echo '<link rel="stylesheet" href="assets/css/TourGuide/listToursGuide.css">';
            break;
        case 'admin-createTourGuide':
        case 'admin-updateTourGuide':
            echo '<link rel="stylesheet" href="assets/css/TourGuide/formToursGuide.css">';

        // Hotel
        case 'admin-listHotel':
            echo '<link rel="stylesheet" href="assets/css/Discount/listDiscount.css">';
            break;
        case 'admin-createHotel':
        case 'admin-updateHotel':
            echo '<link rel="stylesheet" href="assets/css/Discount/formDiscount.css">';
            break;
        // Hotel
        case 'admin-listVehicles':
            echo '<link rel="stylesheet" href="assets/css/Discount/listDiscount.css">';
            break;
        case 'admin-createVehicles':
        case 'admin-updateVehicles':
            echo '<link rel="stylesheet" href="assets/css/Discount/formDiscount.css">';

        // Reports
        case 'admin-listReport':
            echo '<link rel="stylesheet" href="assets/css/Report/listReport.css">';
            break;
        case 'admin-createReport':
        case 'admin-updateReport':
            echo '<link rel="stylesheet" href="assets/css/Report/formReport.css">';
            break;
    }
    ?>
</head>

<body>
    <aside class="sidebar">
        <h2>Tour Manager</h2>
        <nav>
            <ul>
                <li>
                    <a href="?action=admin" class="<?= ($action == 'admin') ? 'active' : '' ?>">
                        <i class="fa-solid fa-suitcase-rolling"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listTours" class="<?= ($action == 'admin-listTours') ? 'active' : '' ?>">
                        <i class="fa-solid fa-suitcase-rolling"></i> Danh Sách Tour
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-calendar-check"></i> Đặt Tour
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listCustomer"
                        class="<?= ($action == 'admin-listCustomer') ? 'active' : '' ?>">
                        <i class="fa-solid fa-users"></i> Khách Hàng
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listUsers" class="<?= ($action == 'admin-listUsers') ? 'active' : '' ?>">
                        <i class="fa-solid fa-user-tie"></i> Quản Trị Viên
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listDiscount"
                        class="<?= ($action == 'admin-listDiscount') ? 'active' : '' ?>">
                        <i class="fa-solid fa-tags"></i> Mã Giảm Giá
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listCategory"
                        class="<?= ($action == 'admin-listCategory') ? 'active' : '' ?>">
                        <i class="fa-solid fa-coins"></i> Danh Mục
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listGuide" class="<?= ($action == 'admin-listGuide') ? 'active' : '' ?>">
                        <i class="fa-solid fa-coins"></i> Hướng Dẫn Viên
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listTourGuide"
                        class="<?= ($action == 'admin-listTourGuide') ? 'active' : '' ?>">
                        <i class="fa-solid fa-file-lines"></i> Trạng Thái HDV
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listReport">
                        <i class="fa-solid fa-file-lines <?= ($action == 'admin-listReport') ? 'active' : '' ?>"></i>
                        Báo Cáo HDV
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listVehicles">
                        <i class="fa-solid fa-bus-simple"></i> Vehicles
                    </a>
                </li>
                <li>
                    <a href="?action=admin-listHotel">
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

        <div class="sidebar-footer">
            <img src="data:image/jpeg;base64,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"
                alt="Admin avatar" />
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
                <input type="hidden" name="action"
                    value="<?= $action === 'admin-listTours' ? 'admin-searchTours' : $action ?>">
                <div class="searchbar">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#6b7280" height="18" viewBox="0 0 20 20" width="18">
                        <path
                            d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387-1.414 1.414-4.387-4.387zm-5.4-1.956a6 6 0 100-8.485 6 6 0 000 8.485z" />
                    </svg>
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
                    <img src="data:image/jpeg;base64,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"
                        alt="User avatar" />
                    <span>Admin User</span>
                </div>
            </div>
        </header>
        <div id="main-content" class="p-3">
            <?php
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

                // Discounts
                case 'admin-listDiscount':
                    (new DiscountController)->listDiscounts();
                    break;
                case 'admin-createDiscount':
                    (new DiscountController)->createDiscount();
                    break;
                case 'admin-updateDiscount':
                    (new DiscountController)->updateDiscount($id);
                    break;
                case 'admin-deleteDiscount':
                    (new DiscountController)->deleteDiscount($id);
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

                // Tour Guides 
                case 'admin-listTourGuide':
                    (new TourGuideController)->listTourGuides();
                    break;
                case 'admin-createTourGuide':
                    (new TourGuideController)->createTourGuide();
                    break;
                case 'admin-updateTourGuide':
                    (new TourGuideController)->updateTourGuide($id);
                    break;
                case 'admin-deleteTourGuide':
                    (new TourGuideController)->deleteTourGuide($id);
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
            }
            ?>
        </div>
    </main>
</body>

</html>