@extends('layouts.master')

@section('title', 'Permissions')

@section('header')
    <div class="row mb-2">
        <div class="col-md-6 col-sm-6 col-6">
            <a class="btn btn-sm btn-info" href="{{ route('permissions') }}">
                <i class="fas fa-arrow-alt-circle-left"></i>
                {{ trans('button.back') }}</a>
        </div>
        <div class="col-md-6 col-sm-6 col-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('permissions') }}">{{ trans('header.breadcrumb.permissions') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('header.breadcrumb.create') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card b-t-green">
        <div class="card-body">
            <form method="POST" action="{{ route('permissions.store') }}">
                @csrf
                @include('pages.assessments.permissions.partials.form')
                <div class="row justify-content-end">
                    <div class="col-md-10 col-sm-9 col-8">
                        <button type="submit" class="btn btn-sm btn-primary">{{ trans('button.create') }}</button>
                        <a class="btn btn-sm btn-warning" href="{{ route('permissions') }}">{{ trans('button.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
