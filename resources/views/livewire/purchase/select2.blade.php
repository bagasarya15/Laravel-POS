<li class="list-group-item d-flex justify-content-between lh-sm">
    <div class="col-lg">
        <h6 class="my-0">Supplier <span class="text-danger small"> *</span></h6>       
        <select class="form-select @error ('supplier_id') is-invalid  @enderror" name="supplier_id" id="select2-supplier">
            <option selected value="">Pilih Supplier</option>
            @foreach ($supplier as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }} | {{ $supplier->desc }}</option>
            @endforeach
        </select>         
        @error('supplier_id')
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</li>