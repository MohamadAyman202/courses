<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('forntend/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <title>Login</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center bg-body-secondary" style="height:100vh">
        <div class="container">
            <div class="row row-sm">
                <div class="col-12">
                    <div class="row row-sm">
                        <div class="col-6 m-auto ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="pt-3 pe-3 ps-3 ms-3">
                                        <h3 class="text-primary">Welcome To Back</h3>
                                        <h5 class="m-0 p-0 ">Student Login Only</h5>
                                    </div>
                                    <form action="{{ route('login') }}" method="post" class="pe-5 ps-5 pb-5 pt-2">
                                        @csrf
                                        <div class="mt-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" placeholder="Email" />
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" placeholder="Password" type="password" />
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="text-center mt-4">
                                            <button class="btn btn-primary btn-md px-5" type="submit">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('forntend/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
