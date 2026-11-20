<div class="form-grid">
    <div class="field field-wide">
        <label for="full_name">Full name</label>
        <input id="full_name" name="full_name" type="text" maxlength="100" value="{{ old('full_name', $customer->full_name ?? '') }}" class="@error('full_name') invalid @enderror" autocomplete="name" required>
        @error('full_name')<p class="field-error">{{ $message }}</p>@enderror
    </div>

    <div class="field">
        <label for="email">Email address</label>
        <input id="email" name="email" type="email" maxlength="100" value="{{ old('email', $customer->email ?? '') }}" class="@error('email') invalid @enderror" autocomplete="email" required>
        @error('email')<p class="field-error">{{ $message }}</p>@enderror
    </div>

    <div class="field">
        <label for="phone">Phone number <span>Optional</span></label>
        <input id="phone" name="phone" type="text" maxlength="20" value="{{ old('phone', $customer->phone ?? '') }}" class="@error('phone') invalid @enderror" autocomplete="tel">
        @error('phone')<p class="field-error">{{ $message }}</p>@enderror
    </div>
</div>

<div class="form-actions">
    <a class="button secondary" href="{{ route('customers.index') }}">Cancel</a>
    <button class="button primary" type="submit">{{ $submitLabel }}</button>
</div>
