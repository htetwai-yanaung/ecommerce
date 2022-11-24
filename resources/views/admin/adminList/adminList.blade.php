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
            <div id="popup" class="d-none">
                <div class="w-25 p-3 shadow rounded-1 bg-light position-absolute top-50 start-50 translate-middle"
                    style="z-index: 10;">
                    <h3 class="text-center">Change Role</h3>
                    <p class="text-center">Do you want to change this account to user?</p>
                    <div class="row px-3">
                        <button class="btn btn-outline-primary col-3" id="cancle">Cancle</button>
                        <button class="btn btn-primary col-3 offset-6" id="confirm">Change</button>
                    </div>
                </div>
            </div>
            <div class="shadow-sm p-4 bg-white rounded-4 h-auto">
                <div class="mb-4 pt-4 d-flex justify-content-between align-items-center">
                    <h2>Admin list</h2>
                    <form action="{{ route('admin#listPage') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="key" value="{{ request('key') }}" class="form-control"
                                placeholder="Search admin...">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Role</th>
                            <th>Tool</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr class="align-items-center" style="height: 90px; line-height: 90px">
                                <td scope="row">{{ $item['id'] }}</td>
                                <td>
                                    @if ($item['image'] == null)
                                        <img src="{{ asset('storage/image/person.svg') }}" alt="default.png"
                                            class="rounded-circle shadow-sm p-3 img-thumbnail"
                                            style="width: 80px; height: 80px; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('storage/image/' . $item['image']) }}" alt="user.png"
                                            class="rounded-circle shadow-sm p-1 img-thumbnail"
                                            style="width: 80px; height: 80px; object-fit:cover;">
                                    @endif
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>{{ $item['phone'] }}</td>
                                <td>{{ $item['address'] }}</td>
                                <td>{{ $item['gender'] }}</td>
                                <td>
                                    <select name="role" id="role" class="form-select mt-4">
                                        <option value="{{ $item['id'] }}" selected>Admin</option>
                                        <option value="{{ $item['id'] }}">User</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    @if ($item['id'] == Auth::user()->id)
                                        <a href="{{ route('admin#editPage', $item['id']) }}" class="text-success"><i
                                                class="bi bi-pen"></i></a>
                                    @else
                                        <a href="{{ route('admin#listDelete', $item['id']) }}" class="text-danger"><i
                                                class="bi bi-trash"></i></a>
                                    @endif
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
        $(document).ready(function() {
            $id = '';
            document.querySelectorAll('#role').forEach(e => {
                e.addEventListener('change', function() {
                    document.getElementById('popup').classList.toggle('d-none');
                    $roles = document.querySelectorAll('#role');
                    for ($i = 0; $i < $roles.length; $i++) {
                        $roles[$i].disabled = true;
                    }
                    $id = e.value;
                });
            });
            $('#cancle').click(function() {
                document.getElementById('popup').classList.toggle('d-none');
                location.reload();
            });
            $('#confirm').click(function() {
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/ajax/change/admin',
                    data: {
                        'id': $id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                    }
                });
                document.getElementById('popup').classList.toggle('d-none');
                location.reload();
            });
        });
    </script>
@endsection
