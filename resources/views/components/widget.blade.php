@php
    $class = match($widget['variant']) {
        'red' => 'bg-red-500',
        'blue' => 'bg-blue-500',
        'orange' => 'bg-orange-500',
        default => 'bg-'.$widget['variant'].'-500',
    };
@endphp
<div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg shadow-lg">
    <div class="flex-auto p-4">
        <div class="flex flex-wrap gap-x-4">
            <div class="relative flex-1 flex-grow flex flex-col justify-between">
                <h5 class="font-bold text-gray-600">{{ $widget['name'] }}</h5>
                <span class="font-semibold">{{ $widget['data'] }}</span>
            </div>
            <div class="relative flex-initial w-auto">
                <div class="inline-flex items-center justify-center w-16 h-16 p-3 text-center text-white rounded-md shadow-lg {{ $class }}">
                    {!! $widget['icon'] ?? null !!}
                </div>
            </div>
        </div>
    </div>
</div>