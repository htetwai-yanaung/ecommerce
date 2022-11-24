<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Shop</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Online Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('admin#categoryPage') }}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('admin#postPage') }}">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('admin#orderPage') }}">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('admin#listPage') }}">Admin List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('admin#userList') }}">User List</a>
                    </li>
                </ul>
            </div>
            <div>
                <!-- Example single danger button -->
                <div class="btn-group px-5">
                    <img @if (Auth::user()->image == null) src="{{ asset('storage/image/person.svg') }}"
                        @else
                            src="{{ asset('storage/image/' . Auth::user()->image) }}" @endif
                        width="60" class="rounded-circle shadow p-1 bg-light dropdown-toggle img-thumbnail mx-5"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu w-100 mt-2">
                        <li><a class="dropdown-item py-2" href="{{ route('admin#changePasswordPage') }}">Change
                                Password</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('admin#editPage', Auth::user()->id) }}">Update
                                Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="submit" value="Logout" class="btn btn-danger col-6 offset-3">
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <section>
        <div class="container-fluid mt-3">
            @yield('content')
        </div>
    </section>

</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>

{{-- JQuery cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@yield('scriptSource')



</html>
