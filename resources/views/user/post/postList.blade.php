@extends('user.layouts.master')

@section('content')
    <div class="d-flex justify-content-between">

        <span class="fs-3">Latest &gt;&gt;</span>

        <a href="{{ route('user#history') }}" class="btn btn-primary"><i class="bi bi-clock-history"></i> History</a>
    </div>
    <hr>
    <div class="row">
        <div class="col-2">
            <div class="rounded-2 shadow-sm bg-white border pb-2">
                <h6 class="fs-5 p-3 border-bottom">Category</h6>
                <a class="text-muted text-decoration-none d-block px-3 mb-2" href="{{ route('user#filter', 'all') }}">All</a>
                @foreach ($category as $key => $item)
                    <div>
                        <a class="text-muted text-decoration-none d-block px-3 mb-2"
                            href="{{ route('user#filter', $item['id']) }}">{{ $item['category_name'] }}</a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col">
            <div class="d-flex flex-wrap" id="postList">
                @if (count($post) != 0)
                    @foreach ($post as $item)
                        <a class="card mx-2 mb-2 shadow-sm text-decoration-none" data-aos="zoom-in"
                            href="{{ route('user#postDetails', $item['post_id']) }}">
                            <div class="" style="width: 15rem; overflow:hidden;">
                                <div class="card-img-top d-flex justify-content-center"
                                    style="height: 200px; overflow:hidden;">
                                    <img src="{{ asset('storage/image/' . $item['post_image']) }}" alt="..."
                                        style="height: 100%; object-fit:cover">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ Str::limit($item['post_name'], '17', '...') }}</h5>
                                    <p class="card-text text-muted">
                                        {{ Str::limit($item['post_description'], '50', ' ...') }}
                                    </p>
                                    <p class="card-text text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star"></i>
                                    </p>
                                    <h5 class="card-text text-primary">Ks {{ $item['post_price'] }}</h5>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <h3>This product is not available for now.</h3>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <span>{{ $post->links() }}</span>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
