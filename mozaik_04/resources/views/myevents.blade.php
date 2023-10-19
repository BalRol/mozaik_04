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
        <script src="myevents.js"></script>
    </head>
    <body style="background-color: #2C2C2C;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My events</a>
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
        <section id="myevents">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center" style="color:white;">
                    <h1 class="mt-3" >Your events</h1>
                    <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; " >
                        <div class="card-body">
                            <h5 class="card-title">This is where events you've created appear.</h5>
                        </div>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button id="createEvent" type="button" class="btn btn-primary mx-auto d-block" style="display: block;">New event</button>
                        </li>
                    </ul>
                    <h1 class="mt-3">Your events of interest</h1>
                    <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; " >
                        <div class="card-body">
                            <h5 class="card-title">This is where events you've interested appear.</h5>
                        </div>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button id="searchEvent" type="button" class="btn btn-primary mx-auto d-block" style="display: block;">Search event</button>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </body>
    <script src="logout.js"></script>
</html>