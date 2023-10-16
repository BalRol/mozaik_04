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
    </head>
    <body style="background-color: #2C2C2C;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
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
          </div>
        </nav>
        <section id="dashboard">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; " >
                        <div class="card-body">
                        <h5 class="card-title">Username</h5>
                        <p class="card-text"><small>Date - Location - Public - Type</small></p>
                        </div>
                      <img class="card-img-top" src="login_form.jpg" alt="Card image cap" style="max-height: 350px; max-width: 100%; object-fit: cover;">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="pt-1"> <button class="btn btn-dark btn-lg btn-block" id="login" type="button">Interest</button> </div>
                      </div>
                    </div>

                    <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; " >
                        <div class="card-body">
                        <h5 class="card-title">Username</h5>
                        <p class="card-text"><small>Date - Location - Public - Type</small></p>
                        </div>
                      <img class="card-img-top" src="login_form.jpg" alt="Card image cap" style="max-height: 350px; max-width: 100%; object-fit: cover;">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="pt-1"> <button class="btn btn-dark btn-lg btn-block" id="login" type="button">Interest</button> </div>
                      </div>
                    </div>
                    <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; " >
                        <div class="card-body">
                        <h5 class="card-title">Username</h5>
                        <p class="card-text"><small>Date - Location - Public - Type</small></p>
                        </div>
                      <img class="card-img-top" src="login_form.jpg" alt="Card image cap" style="max-height: 350px; max-width: 100%; object-fit: cover;">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="pt-1"> <button class="btn btn-dark btn-lg btn-block" id="login" type="button">Interest</button> </div>
                      </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
