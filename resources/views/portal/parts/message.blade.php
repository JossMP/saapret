@if(session("message") && session("type"))

@if(session('type') == 'error')
<x-alert-error>
    {{ session('message') }}
</x-alert-error>
@endif

@if(session('type') == 'success')
<x-alert-success>
    {{ session('message') }}
</x-alert-success>
@endif

@if(session('type') == 'info')
<x-alert-info>
    {{ session('message') }}
</x-alert-info>
@endif

@endif
