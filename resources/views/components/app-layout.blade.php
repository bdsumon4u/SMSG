<div class="flex h-screen overflow-hidden">
    <x-banner />

    <x-splade-toggle data="sidebarOpen, modalDemo" @keydown.window.escape="setToggle('sidebarOpen', false)">
        {{-- Sidebar --}}
        <aside class="hidden md:flex md:shrink-0">
            <div class="flex">
                {{-- Primary --}}
                <x-sidebar.primary />
                {{-- Primary --}}

                <div class="w-56 bg-white border-r border-transparent dark:bg-gray-900 md:border-gray-200 md:dark:border-gray-700">
                    {{-- Secondary --}}
                    <x-sidebar.secondary />
                    {{-- Secondary --}}
                </div>
            </div>
        </aside>
        {{-- Sidebar --}}

        {{-- Mobile --}}
        <div v-show="sidebarOpen" class="md:hidden">
            <div v-show="sidebarOpen"
                @click="setToggle('sidebarOpen', false)"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-40 transition-opacity duration-300 ease-linear"
            >
                <div class="absolute inset-0 opacity-75 bg-gray-900"></div>
            </div>

            <div class="fixed inset-0 z-40 flex">
                <div v-show="sidebarOpen"
                    x-transition:enter-start="-translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="-translate-x-full"
                    class="flex flex-1 w-full max-w-xs duration-200 ease-in-out transform bg-white dark:bg-gray-900"
                >
                    <div class="absolute top-0 right-0 p-1 -mr-14">
                        <button x-show="sidebarOpen" @click="setToggle('sidebarOpen', false)" class="flex items-center justify-center w-12 h-12 rounded-full focus:outline-none focus:bg-gray-600">
                            <svg class="w-6 h-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <x-sidebar.primary />

                    <x-sidebar.secondary />
                </div>

                <div class="shrink-0 w-14"></div>
            </div>
        </div>
        {{-- Mobile --}}

        <div class="flex flex-col flex-1 w-0 overflow-hidden overflow-y-auto">
            {{-- Header --}}
            <div class="sticky top-0 z-10 flex h-16 bg-white border-b shadow shrink-0 dark:bg-gray-900 backdrop-filter backdrop-blur-md md:shadow-none md:py-4 md:border-gray-200 dark:border-gray-700">
                <button @click="setToggle('sidebarOpen', true)" class="px-4 border-r border-gray-200 dark:border-gray-700 text-gray-500 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 focus:text-gray-600 dark:focus:text-gray-500 md:hidden" aria-label="Open sidebar">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>
                <div class="flex justify-between flex-1 px-4 sm:px-6 md:px-8">
                    <div class="flex flex-1">
                        {{-- Search Component --}}
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            @if(\Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <x-splade-dropdown>
                                    <x-slot:trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ auth()->user()->currentTeam->name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                    </x-slot>

                                    <div class="w-60 mt-2 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                        <!-- Team Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-dropdown-link :href="route('teams.show', auth()->user()->currentTeam)">
                                            {{ __('Team Settings') }}
                                        </x-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-dropdown-link :href="route('teams.create')">
                                                {{ __('Create New Team') }}
                                            </x-dropdown-link>
                                        @endcan

                                        <div class="border-t border-gray-200" />

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach(auth()->user()->allTeams() as $team)
                                            <x-splade-form method="PUT" :action="route('current-team.update')" :default="['team_id' => $team->getKey()]">
                                                <x-dropdown-link as="button">
                                                    <div class="flex items-center">
                                                        @if($team->is(auth()->user()->currentTeam))
                                                            <svg class="mr-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        @endif

                                                        <div>{{ $team->name }}</div>
                                                    </div>
                                                </x-dropdown-link>
                                            </x-splade-form>
                                        @endforeach
                                    </div>
                                </x-splade-dropdown>
                            @endif
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <x-splade-dropdown>
                                <x-slot:trigger>
                                    @if(\Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ auth()->user()->name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <div class="w-48 mt-2 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-dropdown-link :href="route('profile.show')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    @if(\Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link :href="route('api-tokens.index')">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200" />

                                    <!-- Authentication -->
                                    <x-splade-form :action="route('logout')">
                                        <x-dropdown-link as="button">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </x-splade-form>
                                </div>
                            </x-splade-dropdown>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Header --}}

            <main class="relative z-0 flex-1 py-3 lg:py-6">
                <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 min-h-(screen-content)">
                    {{ $slot }}
                </div>
            </main>
        </div>

        {{-- <x-wip /> --}}
    </x-splade-toggle>

    <x-splade-script>
        /**
        * Make dark mode switch.
        *
        * @type {HTMLCollectionOf<Element>}
        */
        const darkModeToggles = document.getElementsByClassName("darkModeToggle");

        if (
            localStorage.theme === "dark" ||
            (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }

        for (let i = 0; i < darkModeToggles.length; i++) {
            darkModeToggles[i].onclick = () => {
                if (localStorage.theme === "light") {
                    localStorage.theme = "dark";
                    document.querySelector("html").classList.add("dark");
                    document.querySelector("html").classList.remove("light");
                } else {
                    localStorage.theme = "light";
                    document.querySelector("html").classList.remove("dark");
                    document.querySelector("html").classList.add("light");
                }
            };
        }
    </x-splade-script>
</div>