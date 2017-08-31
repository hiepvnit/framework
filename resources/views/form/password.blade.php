<div class="form-group">
    <label for="{{ $element->name() }}">{{ $element->label() }}</label>
    <input id="{{ $element->name() }}" type="password" {{ $element->attributeToString() }} />
</div>