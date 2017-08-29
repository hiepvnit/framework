<div class="form-group">
    <label for="{{ $element->name() }}">{{ $element->label() }}</label>
    <input id="{{ $element->name() }}" {{ $element->attributeToString() }}
                 type="text" class="form-control"  />
</div>