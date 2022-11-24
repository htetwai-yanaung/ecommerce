@extends('admin.layouts.master')

@section('content')
    <div class="col-6 offset-3">
        <div class="shadow-sm p-4 bg-white rounded-4 h-auto">
            <h2 class="text-center">Edit Category</h2>
            <form action="{{ route('admin#categoryUpdate') }}" method="POST">
                @csrf
                <div class="row mt-5">
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    <input type="text" name="categoryName" value="{{ $data['category_name'] }}" class="form-control"
                        placeholder="Enter category name...">
                    @error('categoryName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row mt-3">
                    <a href="{{ route('admin#categoryPage') }}" class="btn btn-dark col-3">Back</a>
                    <input type="submit" value="Update" class="btn btn-primary col-3 offset-6">
                </div>
            </form>
        </div>
    </div>
@endsection
