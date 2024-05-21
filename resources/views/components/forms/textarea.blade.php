@props(['name', 'placeholder'])

@error($name)
    <p class="error">
        {{ $message }}
    </p>
@enderror

<textarea name="{{ $name }}" id="" cols="30" rows="10" placeholder="{{ $placeholder }}">{{ old($name) }}</textarea>
