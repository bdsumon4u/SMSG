@seoTitle(__('Devices'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-x-4 items-center">
            <div class="font-semibold italic text-gray-700 text-lg">{{ __('Devices') }}</div>
            <Link href="#add-device" class="inline-flex items-center px-3 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold rounded-md w-32 justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"/>
                </svg>

                <span>Add Device</span>
            </Link>
        </div>
    </x-slot>

    <x-splade-modal name="add-device" class="flex">
        <img class="w-full h-full" src="{{ auth()->user()->deviceQR() }}" alt="QR">
        <div>
            <div class="font-medium italic mb-2">You can follow below steps to add your Android phone in the system.</div>

            <ul class="list-decimal text-sm font-medium pl-4">
                <li class="p-1">Download the latest version of Android app from <a class="text-blue-500 underline" href="" target="_blank">here</a>. It is better if you download it directly into your phone.</li>
                <li class="p-1">Install it on your phone. If you don't know how to install the apps not available on Play Store then you can follow <a class="text-blue-500 underline" href="" target="_blank">this guide</a>.</li>
                <li class="p-1">
                    Open the app after the installation, you will be asked to give bunch of permissions.
                    Just click Allow or Yes on all prompts you receive and you will be presented with login window.
                    Scan the QR code with your phone's camera and you will be logged in.
                </li>
                <li class="p-1">Congratulations, You successfully added your Android phone in to the system. Now just start sending & receiving messages.</li>
            </ul>
        </div>
    </x-splade-modal>

    <div class="py-12">
        <div class="rounded border shadow bg-white p-5">
            <x-splade-table :for="$devices">
                <x-splade-cell is_connected>
                    <div @class([$item->is_connected ? 'bg-green-500' : 'bg-red-500', 'px-2 py-1 text-white rounded-sm w-24 text-center font-semibold text-xs'])>{{ $item->is_connected ? 'Connected' : 'Disconnected' }}</div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>