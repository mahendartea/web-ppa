@props(['icon'])

@php
    $icon = $icon ?? 'heroicon-o-question-mark-circle';
@endphp

<span class="inline-block">
    @svg($icon, 'w-6 h-6 text-gray-500')
</span>
