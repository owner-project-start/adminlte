@extends('layouts.master')

@section('title', 'Roles')

@section('header')
    <div class="row mb-2">
        <div class="col-md-6 col-sm-6 col-6">
            <a class="btn btn-sm btn-info" href="{{ route('roles') }}">Back</a>
            <a class="btn btn-sm btn-primary" href="{{ route('roles.create') }}">
                <i class="fas fa-plus-circle"></i> Roles
            </a>
            @can('delete-users')
                <button type="button" data-remote="' . route('users.delete', $user->id) . '" class="btn btn-danger btn-sm" id="delete"><i class="far fa-trash-alt"></i> Delete</button>
            @endcan
        </div>
        <div class="col-md-6 col-sm-6 col-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('roles') }}">Roles</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card b-t-green">
        <div class="card-body">
            <form method="POST" action="{{ route('roles.edit', $role->id) }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                @include('pages.roles.partials.form')
                <div class="row justify-content-end">
                    <div class="col-md-10 col-sm-9 col-8">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        <a class="btn btn-sm btn-warning" href="{{ route('users') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
