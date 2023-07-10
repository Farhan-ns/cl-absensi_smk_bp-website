<div class="mb-3">
    @if($errors->any())
    {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
    @endif
</div>