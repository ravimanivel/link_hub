<!DOCTYPE html>
<html lang="en">
<head>
    <title>Link Hub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="login-page bg-light vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h3 class="mb-3 text-center">Login Now</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="form-left h-100 py-5 px-4">
                                    @if(Session::has('reg_success'))
                                        <p class="alert alert-info" id="reg-success-msg">{{ Session::get('reg_success') }}</p>
                                        <script>
                                            setTimeout(function() {
                                                var msg = document.getElementById('reg-success-msg');
                                                if(msg) {
                                                    msg.style.transition = "opacity 0.5s";
                                                    msg.style.opacity = 0;
                                                    setTimeout(function() { msg.remove(); }, 500);
                                                }
                                            }, 5000);
                                        </script>
                                    @endif
                                    @if(Session::has('login_failed'))
                                        <p class="alert alert-danger" id="reg-danger-msg">{{ Session::get('message') }}</p>
                                        <script>
                                            setTimeout(function() {
                                                var msg = document.getElementById('reg-danger-msg');
                                                if(msg) {
                                                    msg.style.transition = "opacity 0.5s";
                                                    msg.style.opacity = 0;
                                                    setTimeout(function() { msg.remove(); }, 500);
                                                }
                                            }, 5000);
                                        </script>
                                    @endif
                                    <form action="{{ route('login.check') }}" method="post" class="row g-4">
                                        <div class="col-12">
                                            <label>Username<span class="text-danger">*</span></label>
                                            @csrf
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Username">
                                            </div>
                                            @error('email')
                                               <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" class="form-control" name="password"  value="{{ old('password') }}" placeholder="Enter Password">
                                            </div>
                                            @error('password')
                                                 <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{--
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                            <a href="#" class="text-primary">Forgot Password?</a>
                                            </div>
                                        </div> --}}

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
                                            <a href="{{ route('register') }}" class="btn btn-primary w-100 mt-3">Register</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-primary text-white">
                                <div class="text-center">
                                    <i class="bi bi-lock-fill fs-1"></i>
                                    <h2 class="fs-2 mt-3">Link Hub</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
