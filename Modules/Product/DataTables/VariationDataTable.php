<?php

namespace Modules\Product\DataTables;

use Modules\Product\Entities\Variation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VariationDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('product_name', function ($data) {
                return $data->product->product_name ?? '';
            })
            ->addColumn('variation_image', function ($data) {
                // Asumsikan media “images” sudah disetup di model Variation
                $url = $data->getFirstMediaUrl('images', 'thumb');
                return '<img src="' . $url . '" width="50" class="img-thumbnail" />';
            })
            ->addColumn('price_formatted', function ($data) {
                return format_currency($data->price);
            })
            ->addColumn('action', function ($data) {
                return view('product::variations.partials.actions', compact('data'));
            })
            ->rawColumns(['variation_image']);
    }

    public function query(Variation $model)
    {
        return $model->newQuery()->with('product');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('variations-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom(
                "<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>>" .
                "tr" .
                "<'row'<'col-md-5'i><'col-md-7 mt-2'p>>"
            )
            ->orderBy(0)
            ->buttons(
                Button::make('excel')->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::computed('variation_image')
                ->title('Image')
                ->className('text-center align-middle')
                ->exportable(false)
                ->printable(false),

            Column::make('product.product_name')
                ->title('Product')
                ->className('text-center align-middle'),

            Column::make('name')
                ->title('Variation Name')
                ->className('text-center align-middle'),

            Column::computed('price_formatted')
                ->title('Price')
                ->className('text-center align-middle'),

            Column::make('stock')
                ->title('Stock')
                ->className('text-center align-middle'),

            Column::computed('action')
                ->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'Variations_' . date('YmdHis');
    }
}
