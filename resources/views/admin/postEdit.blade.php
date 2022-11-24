@extends('admin.layouts.master')

@section('content')
    <div class="d-flex">
        <div class="col-10 offset-1">
            <div class="shadow-sm p-4 bg-white rounded-4 h-auto">
                <h2 class="text-center">Edit Post</h2>
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('storage/image/' . $postData['post_image']) }}" class="mt-3 shadow-sm rounded"
                            style="width:100%; object-fit:cover;">
                    </div>

                    <form action="{{ route('admin#postUpdate') }}" method="POST" enctype="multipart/form-data"
                        class="col-9">
                        @csrf
                        <div class="row">
                            <div class="col-6 px-4">
                                <div class="row mt-3">
                                    <label class="ps-1">Post name</label>
                                    <input type="text" name="postName"
                                        class="form-control @error('postName') is-invalid @enderror"
                                        placeholder="Enter post name..."
                                        value="{{ old('postName', $postData['post_name']) }}">
                                    <input type="hidden" name="dbImage" value="{{ $postData['post_image'] }}">
                                    <input type="hidden" name="postId" value="{{ $postData['post_id'] }}">
                                    @error('postName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <label class="ps-1">Category</label>
                                    <select name="postCategory"
                                        class="form-select @error('postCategory') is-invalid @enderror">
                                        <option value="">Choose category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item['id'] }}"
                                                @if ($postData['post_category'] == $item['id']) selected @endif>
                                                {{ $item['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('postCategory')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <label class="ps-1">Price</label>
                                    <input type="number" name="postPrice"
                                        class="form-control @error('postPrice') is-invalid @enderror"
                                        placeholder="Enter price..."
                                        value="{{ old('postPrice', $postData['post_price']) }}">
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
                            </div>
                            <div class="col-6 px-4">

                                <div class="row mt-3">
                                    <label class="ps-1">Post description</label>
                                    <textarea name="postDescription" class="form-control @error('postDescription') is-invalid @enderror" cols="30"
                                        rows="8" placeholder="Enter description">{{ old('postDescription', $postData['post_description']) }}</textarea>
                                    @error('postDescription')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row mt-4">
                                    <a href="{{ route('admin#postPage') }}" class="btn btn-danger col-3">Cancle</a>
                                    <input type="submit" value="Update" class="btn btn-primary col-3 offset-6">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
