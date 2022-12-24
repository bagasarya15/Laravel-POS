<div class="col-lg">
    <h6 class="my-0">Supplier <span class="text-danger small"> *</span></h6>
    <div wire:ignore>                
        <select class="form-select" name="supplier_id" id="select2-supplier">
            <option selected value="0">Pilih Supplier</option>
            @foreach ($supplier as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }} | {{ $supplier->desc }}</option>
            @endforeach
        </select>
    </div>
</div>