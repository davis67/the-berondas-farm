{{-- $name
$value
$checked
$label --}}
<label class="toggle-switch @if ($errors->has($name)) text-neg @endif">
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" @if ($checked) checked="checked" @endif>
    <span class="label">{{ $label }}</span>
</label>
