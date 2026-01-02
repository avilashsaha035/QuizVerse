<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('assign_role', function ($user) {
                $roles = \Spatie\Permission\Models\Role::all();
                $options = '';
                foreach ($roles as $role) {
                    $selected = $user->hasRole($role->name) ? 'selected' : '';
                    $options .= "<option value='{$role->name}' {$selected}>{$role->name}</option>";
                }
                return "
                    <form method='POST' action='".route('admin.users.assignRole', $user->id)."'>
                        ".csrf_field()."
                        <select name='role' class='form-select form-select-sm d-inline w-auto'>
                            {$options}
                        </select>
                        <button type='submit' class='btn btn-sm btn-primary ms-1'>Set</button>
                    </form>
                ";
            })
            ->addColumn('action', function ($data) {
                $deleteUrl = route('admin.user.destroy', $data->id);

                return '
                    <form action="'.$deleteUrl.'" method="POST" style="display:inline-block;" class="delete-form">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="button" class="btn btn-sm btn-danger delete-btn">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['assign_role', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::computed('assign_role') ->title('Assign Role') ->exportable(false) ->printable(false) ->addClass('text-center') ->width(400),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
