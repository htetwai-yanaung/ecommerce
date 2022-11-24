@extends('user.layouts.master')

@section('content')
    <div>
        <span class="fs-6 text-success">{{ $data['c_name'] }} <i class="bi bi-chevron-right"></i>
            {{ $data['post_name'] }}</span>
        <hr>
    </div>
    <input type="hidden" id="postId" name="status" value="{{ $data['post_id'] }}">
    @if (Auth::user() == null)
        <input type="hidden" id="isLog" value="notlogin">
    @endif
    <div class="d-flex justify-content-center" style="height: 80vh">
        <div class="col-4 me-4">
            <div class="p-4 shadow-sm rounded bg-white" data-aos="zoom-in">
                <div class="d-flex justify-content-center" style="height: 300px">
                    <img src="{{ asset('storage/image/' . $data['post_image']) }}" style="height: 100%;">
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="p-4 shadow-sm rounded bg-white" data-aos="zoom-in">
                <h3 class="text-primary">{{ $data['post_name'] }}</h3>
                <p>
                    {{ $data['post_description'] }}
                </p>
                <p class="fs-3">{{ $data['post_price'] }} Ks</p>
                <div>
                    <span>Quantity </span>
                    <div class="btn-group">
                        <div class="input-group">
                            <button id="minusBtn" class="btn btn-primary" style="width: 40px;">&#45;</button>
                            <input type="text" value="1" id="qty" class="form-control text-center"
                                style="width: 50px" disabled>
                            <button id="plusBtn" class="btn btn-primary" style="width: 40px;">&#43;</button>

                        </div>
                    </div>
                </div>
                <div class="p-2">
                    {{-- <form action="" class="row">
                        @csrf
                        <input id="addBtn" type="button" value="Add to cart"
                            class="btn btn-warning text-white col ms-1">
                    </form> --}}
                    <div class="row">
                        <button id="addBtn" class="btn btn-primary col-6 offset-6">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $islog = $('#isLog').val();
            if ($('#isLog').val() == 'notlogin') {
                $('#addBtn').click(function() {
                    window.location.replace("/loginPage");
                })
            }

            $qty = $('#qty').val() * 1;
            $('#plusBtn').click(function() {
                $qty = $qty + 1;
                $('#qty').val($qty);
            })
            $('#minusBtn').click(function() {
                if ($qty > 1) {
                    $qty = $qty - 1;
                    $('#qty').val($qty);
                } else {
                    $('#qty').prop('disable', true);
                }
            })

            $postId = $('#postId').val();
            $('#addBtn').click(function() {
                $cartQty = $('#cartQty').text() * 1 + 1;
                $('#cartQty').text($cartQty);
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/cart/order',
                    data: {
                        'postId': $postId,
                        'qty': $qty
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        window.location.href = "http://127.0.0.1:8000/user/home";
                    }
                });
            })
        })
    </script>
@endsection
