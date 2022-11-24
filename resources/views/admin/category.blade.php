@extends('admin.layouts.master')

@section('content')
    <div class="d-flex justify-content-around">
        <div class="col-4">
            {{-- message start --}}
            @if (session('createSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('createSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('deleteSuccess'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('deleteSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('updateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- message end --}}
            <div class="shadow-sm p-4 bg-white rounded-4 h-auto">
                <h2 class="text-center">Create Category</h2>
                <form action="{{ route('admin#categoryCreate') }}" method="POST">
                    @csrf
                    <div class="row mt-5">
                        <input type="text" name="categoryName" class="form-control" placeholder="Enter category name...">
                        @error('categoryName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <input type="submit" value="Add" class="btn btn-primary col-3 offset-9">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-7">
            <div class="shadow-sm p-4 bg-white rounded-4 h-auto">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h2>Category list</h2>
                    <form action="{{ route('admin#categoryPage') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="searchKey" value="{{ request('searchKey') }}" class="form-control"
                                placeholder="Search category...">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($category) == 0)
                            <tr>
                                <td colspan="4">There is no category.</td>
                            </tr>
                        @else
                            @foreach ($category as $item)
                                <tr>
                                    <td scope="row">{{ $item['id'] }}</td>
                                    <td>{{ $item['category_name'] }}</td>
                                    <td>{{ $item['created_at']->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin#categoryEdit', $item['id']) }}" class="text-success"><i
                                                class="bi bi-pen"></i></a> |
                                        <a href="{{ route('admin#categoryDelete', $item['id']) }}" class="text-danger"><i
                                                class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
