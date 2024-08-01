<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #007bff;
            background: linear-gradient(to right, #0062E6, #33AEFF);
        }

        .card-img-left {
            width: 45%;
            background: scroll center url('https://www.rukita.co/stories/wp-content/uploads/2023/02/received_635124041117137.jpeg');
            background-size: cover;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }

        .btn-google {
            color: white !important;
            background-color: #ea4335;
        }

        .btn-facebook {
            color: white !important;
            background-color: #3b5998;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-img-left d-none d-md-flex">
                    </div>
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Login</h5>
                        <form>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInputEmail" placeholder="name@example.com" required autofocus>
                                <label for="floatingInputEmail">Email address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Login</button>
                            </div>

                            <a class="d-block text-center mt-2 small" href="/register">Don't have an account? Register</a>

                            <hr class="my-4">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
