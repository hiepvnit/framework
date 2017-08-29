<div class="form-group">
    <label for="{{ $element->name() }}">{{ $element->label() }}</label>
    <select class="form-control" name="{{ $element->name() }}" id="{{ $element->name() }}">

        @foreach($element->options() as $optionValue => $optionLabel)
            <option  <?php echo ($element->value() == $optionValue) ? "selected" : ""  ?>
                     value="{{ $optionValue }}">{{ $optionLabel }}</option>
        @endforeach
    </select>
</div>