<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="bg-light ">
    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="row">
            <div class="col-4 offset-4 shadow-sm p-4 bg-white">
                <h3 class="text-center">Login</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row my-3">
                        <label class="form-label ps-1">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email...">
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row my-3">
                        <label class="form-label ps-1">Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Enter your password...">
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row my-3">
                        <label class="ps-1">Have no account? <a href="{{ route('registerPage') }}">Register
                                here.</a></label>
                    </div>
                    <div class="row my-3">
                        <input type="submit" value="Login" class="btn btn-primary col-3 offset-9">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
