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
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#info" id="info-tab" data-toggle="tab" role="tab"
                       aria-controls="info" aria-selected="true">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#change-password" id="change-password-tab" data-toggle="tab"
                       role="tab" aria-controls="change-password" aria-selected="true">Change Password</a>
                </li>
                {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#change-avatar" id="change-avatar-tab" data-toggle="tab"--}}
                {{--role="tab" aria-controls="change-avatar" aria-selected="true">Change Profile</a>--}}
                {{--</li>--}}
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="card">
                                <img src="{{ asset(auth()->user()->avatar) }}"
                                     class="card-img img-thumbnail" alt="" id="avatar">
                                <div class="card-img-overlay d-flex flex-column">
                                    <h3 class="card-title link-muted text-capitalize">{{ auth()->user()->name }}</h3>
                                    <button type="button" id="changeImage"
                                            class="mt-auto btn btn-sm btn-x-sm btn-block btn-secondary">
                                        <i class="fas fa-image"></i> Change Image
                                    </button>
                                </div>
                                <input type="file" class="item-img file center-block" id="image" name="file_photo"
                                       style="display:none;"/>
                            </div>
                        </div>
                    </div>
                    @include('pages.profile.partials.infomation')
                </div>
                <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-passwordc-tab">
                    @include('pages.profile.partials.password')
                </div>
                {{--<div class="tab-pane fade" id="change-avatar" role="tabpanel" aria-labelledby="change-avatar-tab">--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-12 d-flex justify-content-center">--}}
                {{--<div class="card m-0">--}}
                {{--<img src="{{ asset(auth()->user()->avatar) }}"--}}
                {{--class="card-img img-thumbnail" alt="" id="avatar">--}}
                {{--<div class="card-img-overlay d-flex flex-column">--}}
                {{--<h3 class="card-title link-muted text-capitalize">{{ auth()->user()->name }}</h3>--}}
                {{--<button type="button" id="changeImage"--}}
                {{--class="mt-auto btn btn-sm btn-x-sm btn-block btn-secondary">--}}
                {{--<i class="fas fa-image"></i> Change Image--}}
                {{--</button>--}}
                {{--</div>--}}
                {{--<input type="file" class="item-img file center-block" id="image" name="file_photo"--}}
                {{--style="display:none;"/>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            Welcome to our system.
        </div>
    </div>

    <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="upload-demo" class="center-block"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-default" data-dismiss="modal">Close</button>
                    <button type="button" id="cropImageBtn" class="btn btn-sm btn-outline-primary"
                            data-remote="{{ route('users.change-avatar', Auth::user()->id) }}">Save
                    </button>
                </div>
            </div>
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
    <script src="{{ asset('js/uploadImage.js') }}"></script>
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
