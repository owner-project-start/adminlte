@extends('layouts.master')

@section('title', 'Users')

@section('header')
    <div class="row mb-2">
        <div class="col-md-6 col-sm-6 col-6">
            <a class="btn btn-sm btn-info" href="{{ route('users') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
        </div>
        <div class="col-md-6 col-sm-6 col-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card b-t-green">
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                @include('pages.users.partials.form')
                <div class="form-group row">
                    <label for="password" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Password:</label>
                    <div class="col-md-8 col-sm-8 col-8">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               id="password"
                               placeholder="Password....">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Confirm
                        Password:</label>
                    <div class="col-md-8 col-sm-8 col-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               placeholder="Confirm Password...." required autocomplete="new-password">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-10 col-sm-9 col-8">
                        <button type="submit" class="btn btn-sm btn-primary">Create</button>
                        <a class="btn btn-sm btn-warning" href="{{ route('users') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
