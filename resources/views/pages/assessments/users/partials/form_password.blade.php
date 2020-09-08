<div class="form-group row">
    <label for="password" class="col-md-2 col-sm-3 col-4 col-form-label text-right">{{ trans('label.password') }}:</label>
    <div class="col-md-8 col-sm-8 col-8">
        <input type="password" class="form-control @error('password') is-invalid @enderror"
               name="password"
               id="password"
               placeholder="{{ trans('placeholder.password') }}">
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-2 col-sm-3 col-4 col-form-label text-right">{{ trans('label.confirm_password') }}:</label>
    <div class="col-md-8 col-sm-8 col-8">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
               placeholder="{{ trans('placeholder.confirm_password') }}" required autocomplete="new-password">
    </div>
</div>
