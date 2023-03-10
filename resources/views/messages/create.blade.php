@seoTitle(__('Send Message'))

<x-app-layout>
    <div class="py-12">
        <div class="p-5 bg-white border rounded shadow">
            <x-splade-form :action="route('messages.store')">
                <div class="grid grid-cols-3 mb-3 gap-x-3">
                    <x-splade-select name="device_id" :label="__('Device')" :options="$devices" option-label="device_name" option-value="id" choices />
                    <x-splade-select name="sim_id" :label="__('SIM')" remote-url="`/sim?device_id=${form.device_id}`" choices />
                    <x-splade-input name="number" :label="__('Number')" />
                </div>
                <x-splade-textarea class="mb-3" name="body" :label="__('Body')" />
                <x-splade-button :label="__('Send')" />
            </x-splade-form>
        </div>
    </div>
</x-app-layout>