@extends('admin.layouts.master')

@section('content')
    <div class="row">
        {{-- message start --}}
        @if (session('successMessage'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-check-lg"></i></strong>{{ session('successMessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- message end --}}
        <div class="col-4 offset-4 shadow-sm p-4 bg-white rounded">
            <h3 class="text-center">Change Password</h3>
            <form method="POST" action="{{ route('admin#changePassword') }}">
                @csrf
                <div class="row my-3">
                    <label class="form-label ps-1">Old password</label>
                    <input type="password" name="oldPassword"
                        class="form-control @error('oldPassword') is-invalid @enderror" placeholder="Enter old password...">
                    @error('oldPassword')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    @if (session('errorMessage'))
                        <div class="text-danger">
                            {{ session('errorMessage') }}
                        </div>
                    @endif
                </div>
                <div class="row my-3">
                    <label class="form-label ps-1">New password</label>
                    <input type="password" name="newPassword"
                        class="form-control @error('newPassword') is-invalid @enderror" placeholder="Enter new password...">
                    @error('newPassword')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row my-3">
                    <label class="form-label ps-1">Confirm new password</label>
                    <input type="password" name="confirmPassword"
                        class="form-control @error('confirmPassword') is-invalid @enderror"
                        placeholder="Confirm new password...">
                    @error('confirmPassword')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row my-3">
                    <input type="submit" value="Change Password" class="btn btn-primary col-5 offset-7">
                </div>
            </form>
        </div>
    </div>
@endsection
