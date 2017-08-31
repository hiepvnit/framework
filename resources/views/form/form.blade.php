<form action="{{ $form->action() }}" method="{{ $form->method() }}">
    @if(true === $form->put)
        <input type="hidden" name="_method" value="put"/>
    @endif

    @if(true === $form->delete)
        <input type="hidden" name="_method" value="delete"/>
    @endif
    {{ csrf_field() }}

    @foreach($form->elements() as $element)
            @if($element->isCallable())
                {!! $element->executeCallback() !!}
            @else
                {!! $element->render() !!}
            @endif

    @endforeach

</form>