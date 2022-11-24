@extends('user.layouts.master')

@section('content')
    <div class="container" style="height: 80vh">
        <div class="d-flex justify-content-between">
            <div class="col-8">
                <div class="bg-white rounded-2 shadow-sm border p-3">
                    <table class="table text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($cartData) != 0)
                                @foreach ($cartData as $item)
                                    <tr>
                                        <td class="text-start ps-4 pt-3">{{ Str::limit($item['postName'], '20', ' ...') }}
                                        </td>
                                        <td class="pt-3">{{ $item['price'] }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="input-group">
                                                    <button id="minusBtn" class="btn btn-primary"
                                                        style="width: 40px;">&#45;</button>
                                                    <input type="text" value="{{ $item['qty'] }}" id="qty"
                                                        class="form-control text-center" style="width: 50px" disabled>
                                                    <button id="plusBtn" class="btn btn-primary"
                                                        style="width: 40px;">&#43;</button>

                                                </div>
                                            </div>
                                            <input type="hidden" id="originalPrice" value="{{ $item['price'] }}">
                                            <input type="hidden" id="cartId" value="{{ $item['id'] }}">
                                            <input type="hidden" id="postId" value="{{ $item['postId'] }}">
                                            <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                                        </td>
                                        <td class="text-end pt-3">
                                            <span id="price">{{ $item['price'] * $item['qty'] }}</span> Ks
                                        </td>
                                        <td><button class="btn btn-outline-primary" id="closeBtn"><i
                                                    class="bi bi-x-lg"></i></button></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">There is no item in your cart.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 ms-2">
                <div class="bg-white rounded-2 shadow-sm border p-3">
                    <div class="bg-light">
                        <div style="border-bottom: 1px dashed #333;">
                            <div class="d-flex justify-content-between px-3 py-2">
                                <span class="text-muted">Subtotal</span>
                                <span class="text-dark fw-bold"><span id="totalPrice">0.0</span> ks</span>
                            </div>
                            <div class="d-flex justify-content-between px-3 py-2">
                                <span class="text-muted">Discount sales</span>
                                <span class="text-dark fw-bold">- 0.0 ks</span>
                            </div>
                            <div class="d-flex justify-content-between px-3 py-2">
                                <span class="text-muted">Total sales tax</span>
                                <span class="text-dark fw-bold">2000 ks</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between px-3 py-2 fw-bold">
                            <span>Total</span>
                            <span><span id="allTotal">0.0</span> ks</span>
                        </div>
                        <div>
                            <button class="btn btn-primary col-12 my-2" id="orderBtn">Order</button>
                            <button class="btn btn-danger col-12" id="clearBtn">Clear Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $qty = $('#qty').val() * 1;
            $plusBtn = document.querySelectorAll('#plusBtn');
            $plusBtn.forEach(e => {
                e.addEventListener('click', function() {
                    $parentNode = $(this).parents('tr');
                    $value = $parentNode.find('#qty').val() * 1 + 1;
                    $value1 = $parentNode.find('#qty').val($value);
                    $originalPrice = $parentNode.find('#originalPrice').val() * 1;
                    $parentNode.find('#price').text($originalPrice * $value);
                    subTotal();
                })
            });

            $minusBtn = document.querySelectorAll('#minusBtn');
            $minusBtn.forEach(e => {
                e.addEventListener('click', function() {
                    $parentNode = $(this).parents('tr');
                    $oldValue = $parentNode.find('#qty').val();
                    if ($oldValue < 2) {
                        e.prop('disable', true);
                    }
                    $value = $parentNode.find('#qty').val() * 1 - 1;
                    $value1 = $parentNode.find('#qty').val($value);
                    $originalPrice = $parentNode.find('#originalPrice').val() * 1;
                    $parentNode.find('#price').text($originalPrice * $value);
                    subTotal();
                })
            });

            $closeBtn = document.querySelectorAll('#closeBtn');
            $closeBtn.forEach(e => {
                e.addEventListener('click', function() {
                    $parentNode = $(this).parents('tr');
                    $cartId = $parentNode.find('#cartId').val();
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/cart/order/delete',
                        data: {
                            'cartId': $cartId
                        },
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
                            location.reload();
                        }
                    });
                    subTotal();
                })
            });


            function subTotal() {
                $allPrice = document.querySelectorAll('#price');
                $totalPrice = 0;
                for ($i = 0; $i < $allPrice.length; $i++) {
                    $price = $allPrice[$i].innerText * 1;
                    $totalPrice += $price;
                }
                console.log($totalPrice);
                $('#totalPrice').text($totalPrice);
                $('#allTotal').text($totalPrice + 2000);
            }
            subTotal();

            $('#clearBtn').click(function() {
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/cart/clear',
                    dataType: 'json',
                    success: function(res) {
                        window.location.replace("http://127.0.0.1:8000/user/home");
                    }
                })
            })

            $('#orderBtn').click(function() {
                $orderList = [];
                $random = Math.floor(Math.random() * 100000001);
                $('tbody tr').each(function(index, row) {
                    $orderList.push({
                        'user_id': $('#userId').val(),
                        'post_id': $(row).find('#postId').val(),
                        'qty': $(row).find('#qty').val(),
                        'total': $(row).find('#price').text(),
                        'order_code': 'OSM' + $random,
                    });
                });

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/order',
                    data: Object.assign({}, $orderList),
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        window.location.replace("http://127.0.0.1:8000/user/home");

                    }
                })
            })
        })
    </script>
@endsection
