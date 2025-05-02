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

**Order Details:**
- Order Number: {{ $order->order_number }}
- Pickup Time: {{ $order->pickup_time->format('F j, Y g:i A') }}
- Total Amount: ${{ number_format($order->total_amount, 2) }}

## Order Items:
@foreach($order->items as $item)
- {{ $item->quantity }}x {{ $item->dish->name }} - ${{ number_format($item->quantity * $item->price, 2) }}
@endforeach

## Important Information
- Please bring this order number or email when collecting your order
- Your order will be ready at the specified pickup time
- Orders not collected within 1 hour of pickup time may need to be reheated

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
{{ $salutation }}<br>
@else
@lang('Regards'),<br>
@endif
{{ config('app.name') }}
@endcomponent 