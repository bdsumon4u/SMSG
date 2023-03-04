<?php

namespace App\Tables;

use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class Devices extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return (fn (): User => auth()->user())()->devices()->getQuery();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id', 'device_id', 'device_name', 'device_model', 'android_version', 'app_version'])
            ->column('id', sortable: true, label: 'ID', searchable: true)
            ->column('device_name', sortable: true, label: 'Name', searchable: true)
            ->column('device_model', sortable: true, label: 'Model', searchable: true)
            ->column('android_version', sortable: true, label: 'Android', searchable: true)
            ->column('app_version', sortable: true, label: 'APP', searchable: true)
            ->column('is_connected', sortable: true, label: 'Status')

            // ->searchInput()
            ->selectFilter('is_connected', [
                true => 'Connected',
                false => 'Disconnected',
            ], label: 'Status')
            // ->withGlobalSearch()

            ->bulkAction('Enable', function (Device $device) {
                $device->update(['is_connected' => true]);
                Toast::success('Device enabled');
            })
            ->bulkAction('Disable', function (Device $device) {
                $device->update(['is_connected' => false]);
                Toast::success('Device disabled');
            })
            ->bulkAction('Remove', function (Device $device) {
                $device->delete();
                Toast::success('Device removed');
            })
            // ->export()
            ->paginate(10);
    }
}
