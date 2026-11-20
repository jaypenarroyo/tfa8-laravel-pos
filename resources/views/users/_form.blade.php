<div class="form-grid">
    <div class="field">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" maxlength="50" value="{{ old('username', $user->username ?? '') }}" class="@error('username') invalid @enderror" autocomplete="username" required>
        <p class="field-help">Usernames must be unique.</p>
        @error('username')<p class="field-error">{{ $message }}</p>@enderror
    </div>

    <div class="field">
        <label for="full_name">Full name</label>
        <input id="full_name" name="full_name" type="text" maxlength="100" value="{{ old('full_name', $user->full_name ?? '') }}" class="@error('full_name') invalid @enderror" autocomplete="name" required>
        @error('full_name')<p class="field-error">{{ $message }}</p>@enderror
    </div>

    <div class="field">
        <label for="email">Email address</label>
        <input id="email" name="email" type="email" maxlength="255" value="{{ old('email', $user->email ?? '') }}" class="@error('email') invalid @enderror" autocomplete="email" required>
        @error('email')<p class="field-error">{{ $message }}</p>@enderror
    </div>

    <div class="field">
        <label for="password">Password @isset($user)<span>Leave blank to keep it</span>@endisset</label>
        <input id="password" name="password" type="password" minlength="8" class="@error('password') invalid @enderror" autocomplete="new-password" @empty($user) required @endempty>
        <p class="field-help">Use at least 8 characters.</p>
        @error('password')<p class="field-error">{{ $message }}</p>@enderror
    </div>

    <div class="field">
        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" autocomplete="new-password" @empty($user) required @endempty>
    </div>

    @isset($user)
        <div class="field field-wide upload-field">
            <div>
                <label for="avatar">Profile picture <span>Optional</span></label>
                <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png,image/webp" class="@error('avatar') invalid @enderror">
                <p class="field-help">JPG, PNG, or WebP; maximum 2 MB. The image is cropped to a 240 × 240 JPEG.</p>
                @error('avatar')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <img class="avatar-preview" src="{{ $user->avatar ? Storage::disk('public')->url($user->avatar) : asset('images/avatar-placeholder.svg') }}" alt="Current avatar for {{ $user->full_name }}">
        </div>
    @endisset
</div>

<div class="form-actions">
    <a class="button secondary" href="{{ route('users.index') }}">Cancel</a>
    <button class="button primary" type="submit">{{ $submitLabel }}</button>
</div>
