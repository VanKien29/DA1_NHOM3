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
                echo '<link rel="stylesheet" href="./assets/css/listTour.css">';
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
        <?php require_once __DIR__ . '/aside.php'; ?>
        <main class="main flex-grow-1">
            <?php require_once __DIR__ . '/header.php'; ?>
            <section class="content p-4">