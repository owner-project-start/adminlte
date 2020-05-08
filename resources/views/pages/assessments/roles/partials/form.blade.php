<div class="form-group row">
    <label for="name" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Name:</label>
    <div class="col-md-8 col-sm-8 col-8">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
               placeholder="Name...." @if(isset($role)) value="{{ $role->name }}"
               @else value="{{ old('name') }}" @endif>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row">

</div>
<div class="form-group row">
    <label for="roles" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Permissions:</label>
    <div class="col-md-8 col-sm-8 col-8">
        <div class="card-columns">
            <ul class="checktree">
                @if(isset($models))
                    @foreach($models as $model)
                        <li class="icheck-primary">
                            <input id="{{ $model['model'] }}" type="checkbox"/><label
                                for="{{ $model['model'] }}" class="text-capitalize">{{ $model['model'] }}</label>
                            <ul>
                                @foreach($model['permissions'] as $permission)
                                    @if(isset($role))
                                        @php $found=false @endphp
                                        @foreach($role->permissions as $rolePermission)
                                            @if($permission->id == $rolePermission->id)
                                                @php $found = true @endphp
                                                @break;
                                            @endif
                                        @endforeach
                                        @if($found)
                                            <li>
                                                <div class="icheck-primary icheck-inline">
                                                    <input type="checkbox" name="permissions[]"
                                                           id="check-{{$permission->id}}"
                                                           value="{{$permission->id}}" checked/>
                                                    <label for="check-{{ $permission->id }}"
                                                           class="text-capitalize">{{ $permission->name }}</label>
                                                </div>
                                            </li>
                                        @else
                                            <li>
                                                <div class="icheck-primary icheck-inline">
                                                    <input type="checkbox" name="permissions[]"
                                                           id="check-{{$permission->id}}"
                                                           value="{{$permission->id}}"/>
                                                    <label for="check-{{ $permission->id }}"
                                                           class="text-capitalize">{{ $permission->name }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @else
                                        <li>
                                            <div class="icheck-primary icheck-inline">
                                                <input type="checkbox" name="permissions[]"
                                                       id="check-{{$permission->id}}"
                                                       value="{{$permission->id}}"/>
                                                <label for="check-{{ $permission->id }}"
                                                       class="text-capitalize">{{ $permission->name }}</label>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>

{{--<div class="form-group row">--}}
{{--<label for="roles" class="col-md-2 col-sm-3 col-4 col-form-label text-right">Permissions:</label>--}}
{{--<div class="col-md-8 col-sm-8 col-8">--}}
{{--@if(isset($permissions))--}}
{{--<div class="row">--}}
{{--@foreach($permissions as $permission)--}}
{{--@if(isset($role))--}}
{{--@php $found=false @endphp--}}
{{--@foreach($role->permissions as $rolePermission)--}}
{{--@if($permission->id == $rolePermission->id)--}}
{{--@php $found = true @endphp--}}
{{--@break;--}}
{{--@endif--}}
{{--@endforeach--}}
{{--@if($found)--}}
{{--<div class="col-md-4 col-sm-6">--}}
{{--<div class="icheck-primary icheck-inline">--}}
{{--<input type="checkbox" name="permissions[]" id="check-{{$permission->id}}"--}}
{{--value="{{$permission->id}}" checked/>--}}
{{--<label for="check-{{ $permission->id }}"--}}
{{--class="text-capitalize">{{ $permission->name }}</label>--}}
{{--</div>--}}
{{--</div>--}}
{{--@else--}}
{{--<div class="col-md-4 col-sm-6">--}}
{{--<div class="icheck-primary icheck-inline">--}}
{{--<input type="checkbox" name="permissions[]" id="check-{{$permission->id}}"--}}
{{--value="{{$permission->id}}"/>--}}
{{--<label for="check-{{ $permission->id }}"--}}
{{--class="text-capitalize">{{ $permission->name }}</label>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endif--}}
{{--@else--}}
{{--<div class="col-md-4 col-sm-6">--}}
{{--<div class="icheck-primary icheck-inline">--}}
{{--<input type="checkbox" name="permissions[]" id="check-{{$permission->id}}"--}}
{{--value="{{$permission->id}}"/>--}}
{{--<label for="check-{{ $permission->id }}"--}}
{{--class="text-capitalize">{{ $permission->name }}</label>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</div>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
