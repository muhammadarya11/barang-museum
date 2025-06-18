@props(['icon', 'color' => 'primary', 'message'])

@php
    $safeMessage = is_array($message) ? implode(', ', $message) : $message;
@endphp

<div class="alert alert-{{ $color }} d-flex align-items-start" role="alert">
    <i class="bi bi-{{ $icon }} me-2 mt-1 fs-5"></i>
    <div>
        {{ $safeMessage }}
    </div>
</div>