@extends('admin.layouts.master')

@section('content')
    <div class="d-flex">
        <div class="col-10 offset-1">
            <div class="shadow-sm p-4 bg-white rounded-4 h-auto">
                <h2 class="text-center">Admin Detail</h2>
                <div class="row">
                    <div class="col-3">
                        @if ($adminData['image'] == null)
                            <img src="{{ asset('storage/image/person.svg') }}" class="mt-3 shadow-sm rounded"
                                style="width:100%; object-fit:cover;">
                        @else
                            <img src="{{ asset('storage/image/' . $adminData['image']) }}" class="mt-3 shadow-sm rounded"
                                style="width:100%; object-fit:cover;">
                        @endif
                    </div>

                    <form action="{{ route('admin#updateAdminAccount') }}" method="POST" enctype="multipart/form-data"
                        class="col-9">
                        @csrf
                        <div class="row">
                            <div class="col-6 px-4">
                                <div class="row mt-3">
                                    <label class="ps-1">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter your name..." value="{{ old('name', $adminData['name']) }}">
                                    <input type="hidden" name="id" value="{{ $adminData['id'] }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <label class="ps-1">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter your email..." value="{{ old('email', $adminData['email']) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <label class="ps-1">Phone Number</label>
                                    <input type="number" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Enter your phone number..."
                                        value="{{ old('phone', $adminData['phone']) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <label class="ps-1">Image</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    <input type="hidden" name="dbImage" value="{{ $adminData['image'] }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 px-4">
                                <div class="row mt-3">
                                    <label class="ps-1">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="">Choose gender</option>
                                        <option value="male" @if ($adminData['gender'] == 'male') selected @endif>Male
                                        </option>
                                        <option value="female" @if ($adminData['gender'] == 'female') selected @endif>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <label class="ps-1">Role</label>
                                    <select name="role" class="form-select">
                                        <option value="">Choose role</option>
                                        <option value="admin" @if ($adminData['role'] == 'admin') selected @endif>Admin
                                        </option>
                                        <option value="user" @if ($adminData['role'] == 'user') selected @endif>User
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <label class="ps-1">Address</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="6"
                                        placeholder="Enter description">{{ old('address', $adminData['address']) }}</textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row mt-4">
                                    <a href="{{ route('admin#listPage') }}" class="btn btn-danger col-3">Cancle</a>
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
