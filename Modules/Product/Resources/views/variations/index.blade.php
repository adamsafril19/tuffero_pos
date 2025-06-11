@extends('layouts.app')

@section('title', 'Product Variations')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="breadcrumb-item active">Variations</li>
    </ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Tampilkan alert jika ada --}}
            @include('utils.alerts')

            <div class="card">
                <div class="card-body">
                    {{-- Tombol “Add Variation” menuju halaman create --}}
                    <a href="{{ route('products.variations.create') }}" class="btn btn-primary mb-3">
                        Add Variation <i class="bi bi-plus"></i>
                    </a>

                    <hr>

                    {{-- Tabel DataTable --}}
                    <div class="table-responsive">
                        {!! $dataTable->table([
                            'class' => 'table table-bordered table-striped table-sm',
                            'style' => 'width:100%;'
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
