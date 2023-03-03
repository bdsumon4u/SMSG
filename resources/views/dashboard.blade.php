@seoTitle(__('Dashboard'))

<x-app-layout>
    <div class="py-12">
        <div class="grid gap-5 xl:grid-cols-4 md:grid-cols-2">
            @foreach ($widgets as $widget)
            <x-widget :widget="$widget" />
            @endforeach
        </div>
    </div>
</x-app-layout>