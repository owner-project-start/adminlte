<div class="form-group row">
    <label for="roles" class="col-md-2 col-sm-3 col-4 col-form-label text-right">{{ trans('label.roles') }}:</label>
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
