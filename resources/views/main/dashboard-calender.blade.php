<div class="col">
    <div class="table-responsive">
        <form action="{{ route('dashboard-search') }}" class="d-inline-flex ms-3">
            <input type="text" class="form-control" name="firstDate" placeholder="Tanggal Awal" onfocus="(this.type='date')"required>
            
            <input type="text" class="form-control ms-2" name="lastDate" placeholder="Tanggal Akhir" onfocus="(this.type='date')" required>
            <button type="submit" class="btn btn-sm btn-primary ms-2"><i class="fa-solid fa-magnifying-glass"></i></button>

            <a href="{{ route('dashboard') }}" class="btn btn-warning ms-1"><i class="fa-solid fa-arrows-rotate"></i> </a>
        </form>
    </div>
</div>