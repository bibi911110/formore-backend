<?php

namespace App\DataTables;

use App\Models\Points_master;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class Points_masterDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'points_masters.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Points_master $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Points_master $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'         => [[0, 'desc']],
                'lengthMenu' => [
                    [ 10, 25, 50,100, -1 ],
                    [ '10', '25', '50','100', 'All' ]
                ],
                'buttons'   => [
                    ['extend' => 'pageLength', 'className' => 'button-margin btn btn-default btn-sm no-corner',],
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'schema',
            'currency_id',
            'ratio_of_collecting_points',
            'ratio_for_cash_out',
            'segments_id',
            'levels_based_on_scenarios',
            'birthday',
            'welcome',
            'fraud_of_points',
            'campaign',
            'start_date',
            'end_date',
            'choose_segments',
            'expiration_date',
            'message_eng',
            'message_italian',
            'message_greek',
            'message_albanian'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'points_masters_datatable_' . time();
    }
}
