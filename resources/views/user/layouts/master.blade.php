<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnlineShop.mm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-light">
    <header>
        <nav class="navbar navbar-expand-lg bg-white px-3 shadow-sm">
            <div class="container-fluid py-2">
                <a class="navbar-brand text-primary" href="#">OnlineStore.mm</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-3">
                            <a class="nav-link active text-primary" aria-current="page"
                                href="{{ route('user#homePage') }}">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <form action="{{ route('user#homePage') }}" method="GET">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="key" value="{{ request('key') }}"
                                        class="form-control" placeholder="Search category...">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="{{ route('user#cartList') }}">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="bi bi-cart-plus-fill"></i>
                                    <span id="cartQty"
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($cart) }}
                                    </span>
                                </button>
                            </a>
                        </li>
                    </ul>
                    @if (Auth::user() == null)
                        <a href="{{ route('registerPage') }}" class="btn btn-primary me-3">Sign up</a>
                        <a href="{{ route('loginPage') }}" class="btn btn-primary">Login</a>
                    @else
                        <a href="{{ route('user#logout') }}" class="btn btn-outline-danger">Logout</a>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="container-fluid mt-4">
            @yield('content')
        </div>
    </section>

    <section class="mx-3">
        <div>
            <span class="fs-4">Suggest for you &gt;&gt;</span>
            <hr>
        </div>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($postData as $item)
                    <div class="swiper-slide" style="width: 200px;">
                        <a class="card mx-2 mb-2 shadow-sm text-decoration-none"
                            href="{{ route('user#postDetails', $item['post_id']) }}">
                            <div class="" style="width:200px; overflow:hidden;">
                                <div class="card-img-top d-flex justify-content-center"
                                    style="height: 180px; overflow:hidden;">
                                    <img src="{{ asset('storage/image/' . $item['post_image']) }}" alt="..."
                                        style="height: 100%; object-fit:cover">
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($item['post_name'], '17', '...') }}</h6>
                                    <p class="card-text text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star"></i>
                                    </p>
                                    <p class="card-text text-success">Ks {{ $item['post_price'] }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <footer class="bg-secondary mt-5">
        <div class="d-flex">
            <div class="d-flex flex-column p-4 col-4">
                <h5>Customer Cart</h5>
                <a class="text-light text-decoration-none" href="">Help center</a>
                <a class="text-light text-decoration-none" href="">How to buy</a>
                <a class="text-light text-decoration-none" href="">Corporate & Bulk Purchasing</a>
                <a class="text-light text-decoration-none" href="">Returns & Refunds</a>
                <a class="text-light text-decoration-none" href="">Contact Us</a>
            </div>
            <div class="d-flex flex-column p-4 col-4">
                <h5>EARN WITH SHOP</h5>
                <a class="text-light text-decoration-none" href="">Shop University</a>
                <a class="text-light text-decoration-none" href="">Sell on Shop</a>
                <a class="text-light text-decoration-none" href="">Code of Conduct</a>
            </div>
            <div class="d-flex flex-column p-4 col-4">
                <h5>Shop</h5>
                <a class="text-light text-decoration-none" href="">About Shop</a>
                <a class="text-light text-decoration-none" href="">Careers</a>
                <a class="text-light text-decoration-none" href="">Shop Cares</a>
                <a class="text-light text-decoration-none" href="">Terms & Conditions</a>
                <a class="text-light text-decoration-none" href="">Privacy Policy</a>
                <a class="text-light text-decoration-none" href="">Online Shopping App</a>
            </div>
        </div>
    </footer>

</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>

{{-- JQuery cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init();
</script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 6,
        spaceBetween: 10,
        slidesPerGroup: 1,
        loop: true,
        loopFillGroupWithBlank: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>

@yield('scriptSource')

</html>
