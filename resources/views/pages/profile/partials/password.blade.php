<div class="form-group row">
    <label for="old_password" class="col-md-4 col-sm-3 col-4 col-form-label text-right">Old Password</label>
    <div class="col-md-8 col-8">
        <input type="text" class="form-control" name="old_password" id="old_password">
        <div class="invalid-feedback old_password"></div>
    </div>
</div>
<div class="form-group row">
    <label for="password" class="col-md-4 col-sm-3 col-4 col-form-label text-right">New Password</label>
    <div class="col-md-8 col-8">
        <input type="text" class="form-control" name="password" id="password">
        <div class="invalid-feedback password"></div>
    </div>
</div>
<div class="form-group row">
    <label for="password_confirmation" class="col-md-4 col-sm-3 col-4 col-form-label text-right">Confirm Password</label>
    <div class="col-md-8 col-8">
        <input type="text" class="form-control" name="password_confirmation" id="password_confirmation">
        <div class="invalid-feedback password_confirmation"></div>
    </div>
</div>
<div class="row justify-content-end">
    <div class="col-md-8 col-sm-9 col-8">
        <button type="submit" class="btn btn-sm btn-primary change-password" data-remote="{{ route('users.change-password', Auth::user()->id) }}">Update</button>
        <a class="btn btn-sm btn-warning" href="{{ route('dashboard') }}">Cancel</a>
    </div>
</div>
