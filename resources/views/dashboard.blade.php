<?php
    if (!isset($_COOKIE['user'])) {
        header("Location: /login");
        exit;
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Events</title>
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/logout.js"></script>
</head>

<body style="background-color: #2C2C2C;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-start align-items-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="/"><img alt="logo" class="img-fluid" src="img/bird.png" style="max-width: 50px;"></img> </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-light" href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="myevents">My events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile">Profile</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end me-2" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button id="logout" type="button" class="btn btn-danger" style="display: block;">Logout</button>
                </li>
            </ul>
        </div>
    </nav>

    <section id="dashboard">
        <div class="container py-5">
            <div class="container mt-5">
                <div class="search-container">
                    <div class="d-flex justify-content-center mt-5">
                        <div class="input-group" style="max-width: 600px;">
                            <input id="searchInput" type="search" id="form1" class="form-control" placeholder="Search..." />
                            <button type="button" id="search" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse" id="advancedSearch">
                        <div class="d-flex justify-content-center mt-3">
                            <div class="input-group" style="max-width: 400px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" color: white; border: none; style="width: 100px;">Start date: </span>
                                </div>
                                <input type="date" class="form-control" id="start_date" placeholder="Start date">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="input-group" style="max-width: 400px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" color: white; border: none; style="width: 100px;">End date: </span>
                                </div>
                                <input type="date" class="form-control" id="end_date" placeholder="End date">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="input-group" style="max-width: 400px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" color: white; border: none; style="width: 100px;">Location: </span>
                                </div>
                                <input type="search" class="form-control" id="location" placeholder="Location">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="input-group" style="max-width: 400px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" color: white; border: none; style="width: 100px;">Visibility: </span>
                                </div>
                                <select id="visibilitySelect" class="selectpicker form-control" data-live-search="true">
                                    <option value="" selected="selected"></option>
                                    <option value="Public">Public</option>
                                    <option value="Only me">Only me</option>
                                    <option value="Limited">Limited</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="input-group" style="max-width: 400px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" color: white; border: none; style="width: 100px;">Category: </span>
                                </div>
                                <select id="categorySelect" class="selectpicker form-control" data-live-search="true">
                                    <option value="" selected="selected"></option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="input-group" style="max-width: 400px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" color: white; border: none; style="width: 100px;">Name: </span>
                                </div>
                                <input type="search" class="form-control" id="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="input-group" style="max-width: 400px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" color: white; border: none; style="width: 100px;">Description: </span>
                                </div>
                                <input type="search" class="form-control" id="description" placeholder="Description">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <button type="button" class="btn btn-link" style="color:white;" data-toggle="collapse" data-target="#advancedSearch" aria-expanded="false">
                            Advanced Search
                        </button>
                    </div>
                </div>
            </div>


            <div class="row d-flex justify-content-center align-items-center" id="dashboard_insert">
                <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; ">
                    <div class="card-body">
                        <h5 class="card-title">This is where events appear.</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="js/logout.js"></script>

</html>
