<?php

namespace App\Sidebar;

use Hotash\Sidebar\Badge;
use Hotash\Sidebar\Group;
use Hotash\Sidebar\Item;
use Hotash\Sidebar\Menu;
use Hotash\Sidebar\Sidebar;

class MainSidebar implements Sidebar
{
    public function __construct(protected Menu $menu)
    {
    }

    /**
     * Build your sidebar implementation here
     */
    public function build()
    {
        $this->menu->group('', function (Group $group) {
            $group->weight(1);
            $group->authorize();

            $group->item('Dashboard', function (Item $item) {
                $item->weight(1);
                $item->route('dashboard');
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 21V11h8v10h-8zM3 13V3h8v10H3zm6-2V5H5v6h4zM3 21v-6h8v6H3zm2-2h4v-2H5v2zm10 0h4v-6h-4v6zM13 3h8v6h-8V3zm2 2v2h4V5h-4z"/>
                    </svg>
                ');
            });
            $group->item('Devices', function (Item $item) {
                $item->weight(1);
                $item->route('devices.index');
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 4v16h10V4H7zM6 2h12a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm6 15a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                ');
            });
            $group->item('Groups', function (Item $item) {
                $item->weight(1);
                $item->route('groups.index');
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M2 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H2zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm8.284 3.703A8.002 8.002 0 0 1 23 22h-2a6.001 6.001 0 0 0-3.537-5.473l.82-1.824zm-.688-11.29A5.5 5.5 0 0 1 21 8.5a5.499 5.499 0 0 1-5 5.478v-2.013a3.5 3.5 0 0 0 1.041-6.609l.555-1.943z"/>
                    </svg>
                ');
            });
            $group->item('Contacts', function (Item $item) {
                $item->weight(1);
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 2h16.005C20.107 2 21 2.898 21 3.99v16.02c0 1.099-.893 1.99-1.995 1.99H3V2zm4 2H5v16h2V4zm2 16h10V4H9v16zm2-4a3 3 0 0 1 6 0h-6zm3-4a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm8-6h2v4h-2V6zm0 6h2v4h-2v-4z"/>
                    </svg>
                ');
            });
            $group->item('Blacklist', function (Item $item) {
                $item->weight(1);
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z"/>
                    </svg>
                ');
            });
        });

        $this->menu->group('Message', function (Group $group) {
            $group->weight(1);
            $group->authorize();

            $group->item('Send', function (Item $item) {
                $item->weight(1);
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14 3v2H4v13.385L5.763 17H20v-7h2v8a1 1 0 0 1-1 1H6.455L2 22.5V4a1 1 0 0 1 1-1h11zm5 0V0h2v3h3v2h-3v3h-2V5h-3V3h3z"/>
                    </svg>
                ');
            });

            $group->item('History', function (Item $item) {
                $item->weight(1);
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5.455 15L1 18.5V3a1 1 0 0 1 1-1h15a1 1 0 0 1 1 1v12H5.455zm-.692-2H16V4H3v10.385L4.763 13zM8 17h10.237L20 18.385V8h1a1 1 0 0 1 1 1v13.5L17.545 19H9a1 1 0 0 1-1-1v-1z"/>
                    </svg>
                ');
            });

            $group->item('Response', function (Item $item) {
                $item->weight(1);
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11 20L1 12l10-8v5c5.523 0 10 4.477 10 10 0 .273-.01.543-.032.81-1.463-2.774-4.33-4.691-7.655-4.805L13 15h-2v5zm-2-7h4.034l.347.007c1.285.043 2.524.31 3.676.766C15.59 12.075 13.42 11 11 11H9V8.161L4.202 12 9 15.839V13z"/>
                    </svg>
                ');
            });

            $group->item('Template', function (Item $item) {
                $item->weight(1);
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5 8v12h14V8H5zm0-2h14V4H5v2zm15 16H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1zM7 10h4v4H7v-4zm0 6h10v2H7v-2zm6-5h4v2h-4v-2z"/>
                    </svg>
                ');
            });
        });

        $this->menu->group('SaaS', function (Group $group) {
            $group->weight(1);
            $group->item('Plans', function (Item $item) {
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 7l8.445-5.63a1 1 0 0 1 1.11 0L21 7v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7zm2 1.07V20h14V8.07l-7-4.666L5 8.07zM12 11a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                    </svg>
                ');
            })->badge(function (Badge $badge) {
                $badge->setValue('Soon');
            });
            $group->item('Users', function (Item $item) {
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3.783 2.826L12 1l8.217 1.826a1 1 0 0 1 .783.976v9.987a6 6 0 0 1-2.672 4.992L12 23l-6.328-4.219A6 6 0 0 1 3 13.79V3.802a1 1 0 0 1 .783-.976zM5 4.604v9.185a4 4 0 0 0 1.781 3.328L12 20.597l5.219-3.48A4 4 0 0 0 19 13.79V4.604L12 3.05 5 4.604zM12 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm-4.473 5a4.5 4.5 0 0 1 8.946 0H7.527z"/>
                    </svg>
                ');
            })->badge(function (Badge $badge) {
                $badge->setValue('Soon');
            });
        });

        $this->menu->group('APP', function (Group $group) {
            $group->weight(1);
            $group->item('Android', function (Item $item) {
                $item->icon('
                    <svg class="w-5 h-5 mr-3 -ml-1 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 10h5l-6 6-6-6h5V3h2v7zm-9 9h16v-7h2v8a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-8h2v7z"/>
                    </svg>
                ')->badge(function (Badge $badge) {
                    $badge->setValue('1.0.0');
                });
            });
        });
    }

    public function getMenu(): Menu
    {
        return $this->menu;
    }
}
