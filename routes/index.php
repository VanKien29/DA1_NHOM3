<?php
$action = $_GET['action'] ?? '/';
$id = $_GET['id'] ?? '/';

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
    default => require './views/admin.php',

};