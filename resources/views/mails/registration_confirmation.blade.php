@component('mail::message')
# Registration successful

{{ $greeting }}

@component('mail::button', ['url' => config('app.url')])
Visit ProgressInsight
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
