<div class="form-group">
    <label for="{{ $element->name() }}">{{ $element->label() }}</label>
    <textarea id="{{ $element->name() }}" {{ $element->attributeToString() }}>{!! $element->value() !!}</textarea>

</div>