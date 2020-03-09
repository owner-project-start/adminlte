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
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Name:</label>
                    <div class="col-md-8 col-sm-8 col-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                               id="name"
                               placeholder="Name...." @if(isset($user)) value="{{ $user->name }}"
                               @else value="{{ old('name') }}" @endif>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Email:</label>
                    <div class="col-md-8 col-sm-8 col-8">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                               id="email"
                               placeholder="E-mail...." @if(isset($user)) value="{{ $user->email }}"
                               @else value="{{ old('email') }}" @endif >
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

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

                <div class="form-group row">
                    <label for="roles" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Roles:</label>
                    <div class="col-md-8 col-sm-8 col-8">
                        @if(isset($roles))
                            <div class="row">
                                @foreach($roles as $role)
                                    @if(isset($user))
                                        @php $found=false @endphp
                                        @foreach($user->roles as $userRole)
                                            @if($role->id == $userRole->id)
                                                @php $found = true @endphp
                                                @break;
                                            @endif
                                        @endforeach
                                        @if($found)
                                            <div class="col-md-4">
                                                <div class="icheck-primary icheck-inline">
                                                    <input type="checkbox" name="roles[]" id="check-{{$role->id}}"
                                                           value="{{$role->id}}" checked/>
                                                    <label for="check-{{ $role->id }}"
                                                           class="text-capitalize">{{ $role->name }}</label>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-4">
                                                <div class="icheck-primary icheck-inline">
                                                    <input type="checkbox" name="roles[]" id="check-{{$role->id}}"
                                                           value="{{$role->id}}"/>
                                                    <label for="check-{{ $role->id }}"
                                                           class="text-capitalize">{{ $role->name }}</label>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="col-md-4">
                                            <div class="icheck-primary icheck-inline">
                                                <input type="checkbox" name="roles[]" id="check-{{$role->id}}"
                                                       value="{{$role->id}}"/>
                                                <label for="check-{{ $role->id }}"
                                                       class="text-capitalize">{{ $role->name }}</label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
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
