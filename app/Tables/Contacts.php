<?php

namespace App\Tables;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class Contacts extends AbstractTable
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
        $groupIDs = (fn (): User => auth()->user())()->groups()->pluck('id');

        return Contact::with('group')->whereIntegerInRaw('group_id', $groupIDs);

        return (fn (): User => auth()->user())()->contacts()->with('group')->getQuery();
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
            ->column('group.name', sortable: true, label: 'Group', searchable: true)
            ->column('name', sortable: true, label: 'Name', searchable: true)
            ->column('number', sortable: true, label: 'Number', searchable: true)
            ->column('is_active', sortable: true, label: 'Status')

            // ->searchInput()
            ->selectFilter('is_active', [
                true => 'Active',
                false => 'Inactive',
            ])
            // ->withGlobalSearch()

            ->bulkAction('Activate', function (Contact $contact) {
                $contact->update(['is_active' => true]);
                Toast::success('Contact activated');
            })
            ->bulkAction('Deactive', function (Contact $contact) {
                $contact->update(['is_active' => false]);
                Toast::success('Contact deactivated');
            })
            ->bulkAction('Remove', function (Contact $contact) {
                $contact->delete();
                Toast::success('Contact removed');
            })
            ->export()
            ->paginate();
    }
}
