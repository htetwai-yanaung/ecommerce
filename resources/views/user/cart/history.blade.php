@extends('user.layouts.master')

@section('content')
    <div style="height: 80vh;">
        <div class="d-flex justify-content-center">
            <div class="col-8 bg-white rounded-2 shadow-sm p-3 ">
                <table class="table table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>State</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($order) != 0)
                            @foreach ($order as $item)
                                <tr>
                                    <td>{{ $item['order_code'] }}</td>
                                    <td>{{ $item['total_price'] }} Ks</td>
                                    <td>
                                        @if ($item['order_state'] == '1')
                                            <span class="text-warning fw-bold">Pending</span>
                                        @elseif ($item['order_state'] == '2')
                                            <span class="text-success fw-bold">Success</span>
                                        @else
                                            <span class="text-danger fw-bold">Reject</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">There is no history yet!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
