<div class="form-group row">
    <label for="name" class="col-md-3 col-sm-2 col-3 col-form-label text-right">Username</label>
    <div class="col-md-9 col-sm-10 col-9">
        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control">
        <div class="invalid-feedback name">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-3 col-sm-2 col-3 col-form-label text-right">E-mail</label>
    <div class="col-md-9 col-sm-10 col-9">
        <input type="text" id="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
    </div>
</div>

<div class="form-group row">
    <label for="username" class="col-md-3 col-sm-2 col-3 text-right">Roles</label>
    <div class="col-md-9 col-sm-10 col-9">
        @if(!empty(Auth::user()->roles))
            @foreach(Auth::user()->roles as $role)
                <span class="badge badge-success">{{ $role->name }}</span>
            @endforeach
        @endif
    </div>

</div>

<div class="row justify-content-end">
    <div class="col-md-9 col-sm-10 col-9">
        <button type="submit" class="btn btn-sm btn-primary update-info"
                data-remote="{{ route('users.update-info', auth()->user()->getAuthIdentifier()) }}">Update
        </button>
        <a class="btn btn-sm btn-warning" href="{{ route('dashboard') }}">Cancel</a>
    </div>
</div>
