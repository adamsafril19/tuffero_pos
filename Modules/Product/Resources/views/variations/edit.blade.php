@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Edit Variation</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.variations.update', $variation) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Product</label>
                    <select name="product_id" class="form-control select2">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $product->id == $variation->product_id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Variation Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $variation->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
