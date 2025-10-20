@props(['courseTitle', 'price', 'buttonText', 'buttonClass', 'buttonSize', 'whatsappUrl'])

@php
    // Set default values if not provided
    $buttonText = $buttonText ?? 'تسجيل عبر الواتساب';
    $buttonClass = $buttonClass ?? 'btn btn-success';
    $buttonSize = $buttonSize ?? 'md';
    
    // Add size class to button class
    $sizeClasses = [
        'sm' => 'btn-sm',
        'md' => '',
        'lg' => 'btn-lg'
    ];
    
    if (isset($sizeClasses[$buttonSize])) {
        $buttonClass .= ' ' . $sizeClasses[$buttonSize];
    }
@endphp

<a href="{{ $whatsappUrl }}" 
   target="_blank" 
   class="{{ trim($buttonClass) }}"
   rel="noopener noreferrer">
    <i class="fab fa-whatsapp me-1"></i>
    {{ $buttonText }}
</a>
