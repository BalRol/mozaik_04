<?php
    if (!isset($_COOKIE['user'])) {
        header("Location: /");
        exit;
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Dashboard - Events</title>
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
        <script src="dashboard.js"></script>
        <script src="logout.js"></script>
    </head>
    <body style="background-color: #2C2C2C;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myevents">My events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile">Profile</a>
                </li>
            </ul>
            <ul class="navbar-nav mx-3">
                <li class="nav-item">
                    <button id="logout" type="button" class="btn btn-danger" style="display: block;">Logout</button>
                </li>
            </ul>
        </div>
        </nav>
        <section id="dashboard">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center" id="dashboard_insert">

                </div>
            </div>
        </section>
    </body>
    <script src="logout.js"></script>
</html>
