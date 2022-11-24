@extends('admin.layouts.master')

@section('content')
    <div class="d-flex justify-content-around">
        <div class="col-3">
            <div class="shadow-sm p-4 bg-white rounded-4 h-auto">
                <h2 class="text-center">Create Post</h2>
                <form action="{{ route('admin#postCreate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-3">
                        <label class="ps-1">Post name</label>
                        <input type="text" name="postName" class="form-control @error('postName') is-invalid @enderror"
                            placeholder="Enter post name..." value="{{ old('postName') }}">
                        @error('postName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <label class="ps-1">Category</label>
                        <select name="postCategory" class="form-select @error('postCategory') is-invalid @enderror">
                            <option value="">Choose category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item['id'] }}">{{ $item['category_name'] }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <label class="ps-1">Post description</label>
                        <textarea name="postDescription" class="form-control @error('postDescription') is-invalid @enderror" cols="30"
                            rows="5" placeholder="Enter description">{{ old('postDescription') }}</textarea>
                        @error('postDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <label class="ps-1">Price</label>
                        <input type="number" name="postPrice" class="form-control @error('postPrice') is-invalid @enderror"
                            placeholder="Enter price..." value="{{ old('postPrice') }}">
                        @error('postPrice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <label class="ps-1">Image</label>
                        <input type="file" name="postImage"
                            class="form-control @error('postImage') is-invalid @enderror">
                        @error('postImage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <input type="submit" value="Create" class="btn btn-primary col-3 offset-9">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
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
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('updateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- message end --}}
            <div class="shadow-sm px-4 bg-white rounded-4 h-auto">
                <div class="mb-4 pt-4 d-flex justify-content-between align-items-center">
                    <h2>Post list</h2>
                    <form action="{{ route('admin#postPage') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="key" value="{{ request('key') }}" class="form-control"
                                placeholder="Search post...">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>Post name</th>
                            <th class="w-50">Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Tools</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($post) == 0)
                            <tr>
                                <td colspan="6">
                                    There is no post.
                                </td>
                            </tr>
                        @else
                            @foreach ($post as $item)
                                <tr>
                                    <td scope="row">{{ $item['post_id'] }}</td>
                                    <td>{{ $item['post_name'] }}</td>
                                    <td>{{ $item['post_description'] }}</td>
                                    <td>
                                        <img src="{{ asset('storage/image/' . $item['post_image']) }}" width="100"
                                            height="100" style="object-fit: cover;">
                                    </td>
                                    <td>{{ $item['post_price'] }} ks</td>
                                    <td colspan="2">
                                        <a href="{{ route('admin#postEdit', $item['post_id']) }}" class="text-success"><i
                                                class="bi bi-pen"></i></a> |
                                        <a href="{{ route('admin#postDelete', $item['post_id']) }}" class="text-danger"><i
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
    <div>
        {{ $post->links() }}
    </div>
@endsection
