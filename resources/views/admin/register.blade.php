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

<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-4 offset-4 shadow-sm p-4 bg-white rounded">
                <h3 class="text-center">Register</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row my-3">
                        <label class="form-label ps-1">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name...">
                    </div>
                    <div class="row my-3">
                        <label class="form-label ps-1">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email...">
                    </div>
                    <div class="row my-3">
                        <label class="form-label ps-1">Phone</label>
                        <input type="number" name="phone" class="form-control" placeholder="Enter your number...">
                    </div>
                    <div class="row my-3">
                        <label class="form-label ps-1">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Choose gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="row my-3">
                        <label class="form-label ps-1">Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter your address...">
                    </div>
                    <div class="row my-3">
                        <label class="form-label ps-1">Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Enter your password...">
                    </div>
                    <div class="row my-3">
                        <label class="form-label ps-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Enter your password again...">
                    </div>
                    <div class="row my-3">
                        <label class="ps-1">Already register? <a href="{{ route('loginPage') }}">Login</a></label>
                    </div>
                    <div class="row my-3">
                        <input type="submit" value="Register" class="btn btn-primary col-3 offset-9">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
