@isset($jsPath)
    <script defer>
        {!! file_get_contents($jsPath) !!}
    </script>
@endisset
