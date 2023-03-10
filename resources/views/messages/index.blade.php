@seoTitle(__('Message History'))

<x-app-layout>
    <div class="py-12">
        <div class="p-5 bg-white border rounded shadow">
            <x-splade-table :for="$messages">
                
            </x-splade-table>
        </div>
    </div>
</x-app-layout>