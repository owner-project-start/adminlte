@extends('layouts.master')

@section('title', 'Dashboard')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <a class="btn btn-sm btn-default" href="{{ route('users') }}">Back</a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    @include('pages.users.partials.form')
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
