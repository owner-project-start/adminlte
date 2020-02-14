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
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card b-t-green">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <img src="{{ asset('img/default.jpg') }}" class="img-thumbnail rounded-circle" alt="">
                        </div>
                        <div class="col-md-12 d-flex justify-content-center mt-2">
                            <h4 class="name text-capitalize text-muted">{{ Auth::user()->name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <br class="d-md-none d-lg-none">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#info" id="info-tab" data-toggle="tab" role="tab"
                               aria-controls="info" aria-selected="true">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#change-password" id="change-password-tab" data-toggle="tab"
                               role="tab" aria-controls="change-password" aria-selected="true">Change Password</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#avatar" id="avatar-tab" data-toggle="tab" role="tab"--}}
{{--                               aria-controls="avatar" aria-selected="true">Change Avatar</a>--}}
{{--                        </li>--}}
                    </ul>
                    <div class="tab-content border border-top-0 p-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                            @include('pages.profile.partials.infomation')
                        </div>
                        <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="profile-tab">
                            @include('pages.profile.partials.password')
                        </div>
{{--                        <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">2</div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            Welcome to our system.
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script src="{{ asset('js/changePassword.js') }}"></script>
    <script>
        $('.update-info').on('click', function () {
            $.ajax({
                url: $(this).attr('data-remote'),
                type: 'PUT',
                data: {
                    name: $('#name').val(),
                },
                success: function (response) {
                    if (response.code === 202) {
                        $('#name').removeClass('is-invalid');
                        $('.name').html(response.data.name);
                        toastr.success(response.message)
                    } else if (response.code === 403) {
                        if (response.validate.name) {
                            $('#name').addClass('is-invalid');
                            $('.name').html(response.validate.name[0]);
                        }
                        toastr.warning(response.message)
                    } else {
                        toastr.error(response.message)
                    }
                }
            })
        });
    </script>
@endpush
