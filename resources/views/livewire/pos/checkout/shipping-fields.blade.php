<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Delivery Type') }}</label>
            <select wire:model="delivery_type" class="form-control">
                <option value="pickup">Pickup</option>
                <option value="delivery">Delivery</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Shipping Option') }}</label>
            <select wire:model="shipping_option" class="form-control"
                    :disabled="$delivery_type !== 'delivery'">
                <option value="JNE">JNE</option>
                <option value="JNT">JNT</option>
                <option value="SICEPAT">SiCepat</option>
                <option value="GOSEND">GoSend</option>
            </select>
        </div>
    </div>
</div>
