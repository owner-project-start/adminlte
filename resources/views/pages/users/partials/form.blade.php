<div class="form-group row">
    <label for="name" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Name:</label>
    <div class="col-md-8 col-sm-8 col-8">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
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
        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
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
                                    <input type="checkbox" name="roles[]" id="check-{{$role->id}}" value="{{$role->id}}" checked/>
                                    <label for="check-{{ $role->id }}" class="text-capitalize">{{ $role->name }}</label>
                                </div>
                            </div>
                        @else
                            <div class="col-md-4">
                                <div class="icheck-primary icheck-inline">
                                    <input type="checkbox" name="roles[]" id="check-{{$role->id}}" value="{{$role->id}}"/>
                                    <label for="check-{{ $role->id }}" class="text-capitalize">{{ $role->name }}</label>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-4">
                            <div class="icheck-primary icheck-inline">
                                <input type="checkbox" name="roles[]" id="check-{{$role->id}}" value="{{$role->id}}"/>
                                <label for="check-{{ $role->id }}" class="text-capitalize">{{ $role->name }}</label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

{{--<div class="form-group row">--}}
{{--    <label for="roles" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Roles:</label>--}}
{{--    <div class="col-md-8 col-sm-8 col-8">--}}
{{--        <select class="custom-select" name="roles[]" id="roles">--}}
{{--            <option selected disabled>Choose Role.....</option>--}}
{{--            @if(isset($roles))--}}
{{--                @foreach($roles as $role)--}}
{{--                    @if(isset($user))--}}
{{--                        @php $found=false @endphp--}}
{{--                        @foreach($user->roles as $userRole)--}}
{{--                            @if($role->id == $userRole->id)--}}
{{--                                @php $found = true @endphp--}}
{{--                                @break;--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                        @if($found)--}}
{{--                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>--}}
{{--                        @else--}}
{{--                            <option value="{{ $role->id }}">{{ $role->name }}</option>--}}
{{--                        @endif--}}
{{--                    @else--}}
{{--                        <option value="{{ $role->id }}">{{ $role->name }}</option>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </select>--}}
{{--    </div>--}}
{{--</div>--}}
