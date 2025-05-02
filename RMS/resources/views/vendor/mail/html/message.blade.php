@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if (isset($level) && $level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@if(isset($introLines) && is_array($introLines))
@foreach ($introLines as $line)
{{ $line }}

@endforeach
@endif

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = isset($level) ? match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    } : 'primary';
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@if(isset($outroLines) && is_array($outroLines))
@foreach ($outroLines as $line)
{{ $line }}

@endforeach
@endif

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent 