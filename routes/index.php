<?php

$action = $_GET['action'] ?? '/';
$id = $_GET['id'] ?? '/';

match ($action) {
    '/'         => (new ProductController)->home(),
    'admin'         => (new ProductController)->admin(),
    'admin-listTours'         => (new TourController)->listTours(),
};