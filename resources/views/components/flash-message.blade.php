@props([
    'type' => 'success',
    'background' => [
        'success' => 'flash-success',
        'warning' => 'flash-warning',
        'danger' => 'flash-danger'
    ]
])

<section
    {{ $attributes->merge(['class' => "{$background[$type]} flash-message"]) }}
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 1250)"
    x-transition.duration.1000ms
>
    <div>
        {{ $slot }}
    </div>
</section>