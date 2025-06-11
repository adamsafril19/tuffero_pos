@extends('layouts.app')

@section('title', 'Create Variation')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.variations.index') }}">Variations</a></li>
        <li class="breadcrumb-item active">Add</li>
    </ol>
@endsection

@section('content')
<div class="container-fluid">
    <form id="variation-form" action="{{ route('products.variations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-lg-12">
                @include('utils.alerts')
                <button type="submit" class="btn btn-primary">
                    Create Variation <i class="bi bi-check"></i>
                </button>
            </div>
        </div>

        <div class="row">
            {{-- Basic Fields --}}
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-body">
                        {{-- Product --}}
                        <div class="form-group">
                            <label for="product_id">Product <span class="text-danger">*</span></label>
                            <select name="product_id" id="product_id" class="form-control select2 @error('product_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Select Product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Variation Name --}}
                        <div class="form-group">
                            <label for="name">Variation Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                required
                            >
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="form-group">
                            <label for="price">Price (Rp) <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="price"
                                id="price"
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price') }}"
                                required
                            >
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div class="form-group">
                            <label for="stock">Stock <span class="text-danger">*</span></label>
                            <input
                                type="number"
                                name="stock"
                                id="stock"
                                class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock') }}"
                                min="0"
                                required
                            >
                            @error('stock')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image Upload via Dropzone --}}
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image">Variation Images
                                <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top"
                                    title="Max Files: 3, Max File Size: 1MB, Image Size: 400x400"></i>
                            </label>
                            <div class="dropzone d-flex flex-wrap align-items-center justify-content-center"
                                 id="variation-dropzone">
                                <div class="dz-message" data-dz-message>
                                    <i class="bi bi-cloud-arrow-up"></i> Drop images here or click to upload
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hidden inputs for uploaded files will be appended via JavaScript --}}
    </form>
</div>
@endsection

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')
<script>
    var uploadedVariationMap = {};
    Dropzone.options.variationDropzone = {
        url: '{{ route('dropzone.upload') }}',
        maxFilesize: 1, // MB
        acceptedFiles: '.jpg, .jpeg, .png',
        maxFiles: 3,
        addRemoveLinks: true,
        dictRemoveFile: "<i class='bi bi-x-circle text-danger'></i> remove",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        success: function (file, response) {
            // Tambahkan input hidden berisi nama file
            $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">');
            uploadedVariationMap[file.name] = response.name;
        },
        removedfile: function (file) {
            file.previewElement.remove();
            var name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name;
            } else {
                name = uploadedVariationMap[file.name];
            }
            $.ajax({
                type: "POST",
                url: "{{ route('dropzone.delete') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'file_name': `${name}`
                },
            });
            $('form').find('input[name="images[]"][value="' + name + '"]').remove();
        },
        init: function () {
            @if(isset($variation) && $variation->getMedia('images'))
                var files = {!! json_encode($variation->getMedia('images')) !!};
                for (var i in files) {
                    var file = files[i];
                    this.options.addedfile.call(this, file);
                    this.options.thumbnail.call(this, file, file.original_url);
                    file.previewElement.classList.add('dz-complete');
                    $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">');
                }
            @endif
        }
    };

    // Format currency on price field
    $(document).ready(function () {
        $('#price').maskMoney({
            prefix:'{{ settings()->currency->symbol }}',
            thousands:'{{ settings()->currency->thousand_separator }}',
            decimal:'{{ settings()->currency->decimal_separator }}',
        });

        $('#variation-form').submit(function () {
            var price_unmasked = $('#price').maskMoney('unmasked')[0];
            $('#price').val(price_unmasked);
        });
    });
</script>
@endpush
