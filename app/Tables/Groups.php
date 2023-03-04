<?php

namespace App\Tables;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class Groups extends AbstractTable
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
        return (fn (): User => auth()->user())()->groups()->getQuery();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id'])
            ->column('id', sortable: true, label: 'ID', searchable: true)
            ->column('name', sortable: true, label: 'Name', searchable: true)
            ->column('is_active', sortable: true, label: 'Status')
            ->column('edit', sortable: false, label: 'Edit')

            // ->searchInput()
            ->selectFilter('is_active', [
                true => 'Active',
                false => 'Inactive',
            ])
            // ->withGlobalSearch()

            ->bulkAction('Activate', function (Group $group) {
                $group->update(['is_active' => true]);
                Toast::success('Group activated');
            })
            ->bulkAction('Deactive', function (Group $group) {
                $group->update(['is_active' => false]);
                Toast::success('Group deactivated');
            })
            ->bulkAction('Remove', function (Group $group) {
                $group->delete();
                Toast::success('Group removed');
            })
            // ->export()
            ->paginate(10);
    }
}
