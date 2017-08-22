<div class="form-group">
    <label>{{ $field->label() }}</label>
    <select class="form-control">
        @foreach($field->option() as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
        @endforeach
    </select>
</div>