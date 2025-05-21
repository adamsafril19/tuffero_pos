@extends('layouts.app')

@section('title', 'Import Data Shopee')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales</a></li>
        <li class="breadcrumb-item active">Import Data Shopee</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div>
                            <h4 class="card-title">
                                Import Data Pesanan Shopee
                            </h4>
                            <p class="card-text small">
                                Import data pesanan dari file Excel Shopee
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <h5>Petunjuk Import:</h5>
                                    <ol>
                                        <li>File harus dalam format Excel (.xlsx atau .xls)</li>
                                        <li>Pastikan kolom-kolom berikut ada dalam file Excel:
                                            <ul>
                                                <li>No. Pesanan</li>
                                                <li>Status Pesanan</li>
                                                <li>Nama Produk</li>
                                                <li>SKU Produk</li>
                                                <li>Harga Satuan</li>
                                                <li>Jumlah</li>
                                                <li>Total Harga Barang (Subtotal)</li>
                                                <li>Total Pembayaran</li>
                                            </ul>
                                        </li>
                                        <li>Kolom lain seperti No. Resi, Opsi Pengiriman, dll. akan diproses jika tersedia</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('shopee.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Pilih File Excel</label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-upload"></i> Import Data
                                </button>
                                <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
