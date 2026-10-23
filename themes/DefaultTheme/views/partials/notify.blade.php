@if (isset($errors) && $errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp
    <script type="module">
        @foreach ($errors as $error)
        toastr.error("{{ __($error) }}");
        @endforeach
    </script>
@endif
