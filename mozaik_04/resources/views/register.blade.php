<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Events</title>
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="vh-100" style="background-color: #1E549D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block"> <img src="login_form.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height:100%;" /> </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form>
                                        <div class="d-flex align-items-center mb-1 pb-1"> <img alt="logo" class="img-fluid" src="bird.png"></img> <span class="h1 fw-bold mb-0">Events</span> </div>
                                        <h5 class="fw-normal " style="letter-spacing: 1px;">Register your account</h5>
                                        <div class="form-outline"> <input type="username" id="registerUsername" class="form-control form-control-lg" /> <label class="form-label" for="registerUsername">Username</label> </div>
                                        <div class="form-outline"> <input type="email" id="registerEmail" class="form-control form-control-lg" /> <label class="form-label" for="registerEmail">Email address</label> </div>
                                        <div class="form-outline"> <input type="password" id="registerPassword" class="form-control form-control-lg" /> <label class="form-label" for="registerPassword">Password</label> </div>
                                        <div class="form-outline"> <input type="password" id="registerPasswordAgain" class="form-control form-control-lg" /> <label class="form-label" for="registerPasswordAgain">Repeat your password</label> </div>
                                        <div class="pt-1 mb-4"> <button class="btn btn-dark btn-lg btn-block" type="button">Register</button> </div>
                                        <p style="color: #393f81;">You have an account? <a href="/" style="color: #393f81;">Login here</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
