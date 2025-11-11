<?php

$action = $_GET['action'] ?? '/';
$id = $_GET['id'] ?? '/';

match ($action) {
    '/'         => (new ProductController)->home(),
    'admin'         => (new ProductController)->admin(),
    'admin-listTours'         => (new TourController)->listTours(),
    'admin-deleteTour'         => (new TourController)->deleteTour($id),
    'admin-createTours'         => (new TourController)->createTours(),
    'admin-updateTours'         => (new TourController)->updateTours(),
    
    //admin user
    'admin-listUsers'         => (new UsersController)->listUsers(),
    'admin-deleteUser'         => (new UsersController)->deleteUser($id),
    'admin-createUser'         => (new UsersController)->createUser(),
    'admin-updateUser'         => (new UsersController)->updateUser(),
};