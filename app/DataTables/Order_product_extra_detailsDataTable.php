<?php

namespace App\DataTables;

use App\Models\Order_product_extra_details;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class Order_product_extra_detailsDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'order_product_extra_details.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order_product_extra_details $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order_product_extra_details $model)
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
            'product_id',
            'name',
            'available_quantities',
            'points_per_quantity',
            'price_per_quantity',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'order_product_extra_details_datatable_' . time();
    }
}
