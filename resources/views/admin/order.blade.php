@extends('admin.layouts.master')

@section('content')
    <div class="d-flex justify-content-around">
        <div class="col-10">
            {{-- message start --}}
            @if (session('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('updateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('deleteSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('deleteSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- message end --}}
            <div class="shadow-sm p-4 bg-white rounded-4 h-auto">
                <div class="mb-4 pt-4 d-flex justify-content-between align-items-center">
                    <h2>Order list</h2>
                    <form action="{{ route('admin#orderPage') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="key" value="{{ request('key') }}" class="form-control"
                                placeholder="Search with order code...">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Order Code</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Date</th>
                            <th scope="col">State</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th scope="row"  class="align-middle">{{ $item['id'] }}</th>
                                <td class="align-middle">{{ $item['userName'] }}</td>
                                <td  class="align-middle">
                                    {{ $item['order_code'] }}
                                    <input type="hidden" id="orderCode" value="{{ $item['order_code'] }}">
                                </td>
                                <td  class="align-middle">{{ $item['total_price'] }} Ks</td>
                                <td  class="align-middle">{{ $item['created_at']->format('d-m-Y') }}</td>
                                <td>
                                    <select name="order_state" id="order_state" class="form-select fw-bold">
                                        <option value="0" @if ($item['order_state'] == 0) selected @endif class="bg-white text-dark">Reject</option>
                                        <option value="1" @if ($item['order_state'] == 1) selected @endif class="bg-white text-dark">Pending</option>
                                        <option value="2" @if ($item['order_state'] == 2) selected @endif class="bg-white text-dark">Success</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $orderState = document.querySelectorAll('#order_state');
            for($i=0; $i<$orderState.length; $i++){
                $state = $orderState[$i].value;
                console.log($state);
                if($state == 1){
                    $orderState[$i].style.color = '#ffc107';
                }else if($state == 2){
                    $orderState[$i].style.color = '#198754';
                }else{
                    $orderState[$i].style.color = '#dc3545';
                }
            }
            $orderState.forEach(e => {
                e.addEventListener('change',function(){
                    $parentNode = $(this).parents('tr');
                    $status = $parentNode.find('#order_state').val();
                    $orderCode = $parentNode.find('#orderCode').val();
                    console.log($status +"/" + $orderCode);
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/admin/order/state',
                        data: {
                            'order_code' : $orderCode,
                            'order_state': $status
                        },
                        dataType: 'json',
                        success: function(res){
                            location.reload();
                        }
                    })
                })
            });
        })
    </script>
@endsection
