@component('mail::message')
# Productos

The body of your message.

@component('mail::table')
| Productos     |
| ------------- |
@foreach ($productos as $p)
|   {{ $p->producto }}  |
@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
