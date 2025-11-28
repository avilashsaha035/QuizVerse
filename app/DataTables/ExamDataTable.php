<?php

namespace App\DataTables;

use App\Models\Exam;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ExamDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'exam.action')
            ->editColumn('exam_type', function ($data) {
                return strtoupper($data->exam_type);
            })
            ->editColumn('start_date', function ($data) {
                if ($data->start_date && $data->start_time) {
                    $dt = Carbon::parse($data->start_date . ' ' . $data->start_time);
                    return $dt->format('d M Y | h:i A');
                }
                return null;
            })
            ->editColumn('end_date', function ($data) {
                if ($data->end_date && $data->end_time) {
                    $dt = Carbon::parse($data->end_date . ' ' . $data->end_time);
                    return $dt->format('d M Y | h:i A');
                }
                return null;
            })
            ->addColumn('action', function ($data) {
                $editUrl   = route('admin.exams.edit', $data->id);
                $deleteUrl = route('admin.exams.destroy', $data->id);

                return '
                    <a href="'.$editUrl.'" class="btn btn-sm btn-primary"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                    <form action="'.$deleteUrl.'" method="POST" style="display:inline-block;">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm(\'Are you sure you want to delete this exam?\')">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Exam $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('exam-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
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
            Column::make('title'),
            Column::make('exam_type'),
            Column::make('duration_minutes')->title('Duration (minutes)'),
            Column::make('no_of_ques'),
            Column::make('pass_marks'),
            Column::make('start_date')->title('Start DateTime'),
            Column::make('end_date')->title('End DateTime'),
            Column::computed('action')->width(60)->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Exam_' . date('YmdHis');
    }
}
