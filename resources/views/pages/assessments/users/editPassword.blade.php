@extends('layouts.master')

@section('title', 'Users')

@section('header')
    <div class="row mb-2">
        <div class="col-md-6 col-sm-6 col-6">
            @can('users-managements')
                <a class="btn btn-sm btn-info" href="{{ route('users') }}"><i class="fas fa-arrow-alt-circle-left"></i>
                    {{ trans('button.back') }}</a>
            @endcan
        </div>
        <div class="col-md-6 col-sm-6 col-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('users') }}">{{ trans('header.breadcrumb.users') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('header.breadcrumb.change_password') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card b-t-green">
        <div class="card-body">
            <form method="POST" action="{{ route('users.update-password', $user->id) }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                @include('pages.assessments.users.partials.form_password')
                <div class="row justify-content-end">
                    <div class="col-md-10 col-sm-9 col-8">
                        <button type="submit" class="btn btn-sm btn-primary">{{ trans('button.update') }}</button>
                        <a class="btn btn-sm btn-warning" href="{{ route('users') }}">{{ trans('button.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
