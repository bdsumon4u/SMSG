@seoTitle(__('Contacts'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-x-4 items-center">
            <div class="font-semibold italic text-gray-700 text-lg">{{ __('Contacts') }}</div>
            <Link href="#add-contact" class="inline-flex items-center px-3 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-semibold rounded-md w-32 justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"/>
                </svg>

                <span>Add Contact</span>
            </Link>
        </div>
    </x-slot>

    <x-splade-modal name="add-contact" max-width="sm">
        <x-splade-form :action="route('contacts.store')">
            <x-splade-select name="group_id" :options="$groups" choices>
                <x-slot name="label" class="flex gap-x-2">
                    <Link href="{{ route('groups.index') }}" class="block mb-1 text-blue-700 underline font-sans">{{ __('Group') }}</Link>
                </x-slot>
            </x-splade-select>
            <x-splade-input class="mt-2" name="name" :label="__('Name')" />
            <x-splade-input class="mt-2" name="number" :label="__('Number')" />
            <x-splade-submit class="mt-2" label="Create" />
        </x-splade-form>
    </x-splade-modal>

    <div class="py-12">
        <div class="rounded border shadow bg-white p-5">
            <x-splade-table :for="$contacts">
                <x-splade-cell is_active>
                    <div @class([$item->is_active ? 'bg-green-500' : 'bg-red-500', 'px-2 py-1 text-white rounded-sm w-24 text-center font-semibold text-xs'])>{{ $item->is_active ? 'Active' : 'Inactive' }}</div>
                </x-splade-cell>
                <x-splade-cell edit>
                    <Link href="#edit-contact-{{ $item->id }}" class="inline-flex items-center px-3 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-medium rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 6.757l-2 2V4h-9v5H5v11h14v-2.757l2-2v5.765a.993.993 0 0 1-.993.992H3.993A1 1 0 0 1 3 20.993V8l6.003-6h10.995C20.55 2 21 2.455 21 2.992v3.765zm.778 2.05l1.414 1.415L15.414 18l-1.416-.002.002-1.412 7.778-7.778z"/>
                        </svg>
                        <span>Edit</span>
                    </Link>

                    <x-splade-modal :name="'edit-contact-'.$item->id" max-width="sm">
                        <x-splade-form :action="route('contacts.update', $item)" method="PATCH" :default="$item">
                            <x-splade-input name="name" />
                            <x-splade-input name="number" />
                            <x-splade-submit class="mt-2" label="Update" />
                        </x-splade-form>
                    </x-splade-modal>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>