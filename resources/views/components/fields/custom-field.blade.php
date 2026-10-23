@if (view()->exists('components.fields.' . $data->type))
    @include ('components.fields.' . $data->type, ['data' => $data])
@else
    @include ('components.fields.text', ['data' => $data])
@endif
