<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new ProductController)->home(),
    'admin'         => (new ProductController)->admin(),
    'admin-listTours'         => (new TourController)->listTours(),
};