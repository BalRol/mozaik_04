<?php
if (!isset($_COOKIE['user'])) {
    header("Location: /");
    exit;
}

?> <html lang="en">
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
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="profile.js"></script>

    </head>
    <body style="background-color: #2C2C2C;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="myevents">My events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
                <ul class="navbar-nav mx-3">
                    <li class="nav-item">
                        <button id="logout" type="button" class="btn btn-danger" style="display: block;">Logout</button>
                    </li>
                </ul>
            </div>
        </nav>
        <section id="profile">
            <div class="container" style="margin-top:90px; max-width:650px;">
                <div id="profileForm" class="row">
                    <div class="card mb-4" style="background-color: #111111; color:white;">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center">
                                <img id="profile-image" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid m-5" style="width: 250px; height: 250px;">
                                <input type="file" id="image-input" accept="image/*" style="display: none" name="profile_image">
                            </div>
                            <h5 class="my-3"><span class="name">Full Name</span></h5>
                            <p class=" mb-1"><span class="email">Email</span></p>
                        </div>
                    </div>
                    <div class="card mb-4" style="background-color: #111111; color:white;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                      <input type="text" id="nameInput" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                      <input type="text" id="emailInput" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <button id="changePassword" type="button" class="btn btn-danger">Change password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="save" type="button" class="btn btn-success mx-auto" style="display: block; margin-top: 20px;">Save</button>
            </div>
        </section>
    </body>
    <script src="logout.js"></script>
</html>
