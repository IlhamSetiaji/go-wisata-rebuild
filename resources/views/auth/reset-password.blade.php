<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Go-Wisata ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center
          min-vh-100">
            <div class="col-12 col-md-8 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('layouts.alert')
                        <div class="mb-4">
                            <h5>Reset Password</h5>
                            <p class="mb-2">Please use below form to reset your password.
                            </p>
                        </div>
                        <form action="{{ url('/reset-password') }}" method="POST" enctype="multipart/form-data"
                            novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="Enter Your New Password" required="">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Confirmation</label>
                                <input type="password" id="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Your New Password" required="">
                            </div>
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ request('email') }}">
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                            <span>Do you have an account? <a href="{{ url('/login') }}">Sign In</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
