<div class="form-group row">
    <label for="name" class="col-md-2 col-sm-3 col-4 col-form-label text-right">{{ trans('label.name') }}:</label>
    <div class="col-md-8 col-sm-8 col-8">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
               placeholder="{{ trans('placeholder.name') }}" @if(isset($user)) value="{{ $user->name }}"
               @else value="{{ old('name') }}" @endif>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-2 col-sm-3 col-4 col-form-label text-right">{{ trans('label.email') }}:</label>
    <div class="col-md-8 col-sm-8 col-8">
        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
               placeholder="{{ trans('placeholder.email') }}" @if(isset($user)) value="{{ $user->email }}"
               @else value="{{ old('email') }}" @endif >
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
