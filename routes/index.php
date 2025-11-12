<?php
$action = $_GET['action'] ?? '/';

match ($action) {
    '/' => (new ProductController)->home(),

    // Trang admin
    'admin' => require './views/admin.php',

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

    //login 
    'login' => require './views/login.php',
    
    default => require './views/admin.php',

};