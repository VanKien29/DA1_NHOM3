<?php
$action = $_GET['action'] ?? '/';

match ($action) {
    '/' => (new ProductController)->home(),

    // Admin Home
    'admin' => require './views/admin.php',

    //login 
    'login'=>  (new AuthController)->login(),
    'logout'=>  (new AuthController)->logout(),
    
    // Tour
    'admin-listTours' => require './views/admin.php',
    'admin-createTours' => require './views/admin.php',
    'admin-updateTours' => require './views/admin.php',

    // User
    'admin-listUsers' => require './views/admin.php',
    'admin-createUsers' => require './views/admin.php',
    'admin-updateUsers' => require './views/admin.php',
    
    // Category
    'admin-listCategory' => require './views/admin.php',
    'admin-createCategory' => require './views/admin.php',
    'admin-updateCategory' => require './views/admin.php',
    
    // Customer
    'admin-listCustomer' => require './views/admin.php',
    'admin-createCustomer' => require './views/admin.php',
    'admin-updateCustomer' => require './views/admin.php',
    
    // Discount
    'admin-listDiscount' => require './views/admin.php',
    'admin-createDiscount' => require './views/admin.php',
    'admin-updateDiscount' => require './views/admin.php',

    // Hotel
    'admin-listHotel' => require './views/admin.php',
    'admin-createHotel' => require './views/admin.php',
    'admin-updateHotel' => require './views/admin.php',

    // Vehicles
    'admin-listVehicles' => require './views/admin.php',
    'admin-createVehicles' => require './views/admin.php',
    'admin-updateVehicles' => require './views/admin.php',
    
    default => require './views/admin.php',
};