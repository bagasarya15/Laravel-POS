@extends('layouts.main')

@section('menu-heading')
    System Update
@endsection

@section('title')
    Detail Info
@endsection

@section('content')
<section id="multiple-column-form">
    @include('layouts.sweet-alert')
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('system-info.index') }}"><i class="fa-solid fa-angles-left"></i> Kembali</a>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        {{-- Start Form Action  --}}
                        <form action="{{ route('system-info.update', $systemUpdate->id) }}" method="POST" class="form form-horizontal">
                            @csrf
                            @method('PUT')    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="category_id" id="category_id" class="form-select" id="basicSelect">
                                            @foreach ($categories as $category)
                                            <option {{ ($systemUpdate->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Deksripsi</label>
                                        <textarea class="form-control" name="desc" id="desc" rows="3" required>{{ $systemUpdate->desc }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="created_at">Dibuat</label>
                                        <input type="text" id="created_at" class="form-control" name="created_at" value="{{ Carbon\Carbon::parse($systemUpdate->created_at)->translatedFormat('d F Y') }}" disabled>
                                        <input type="hidden" value="{{ Carbon\Carbon::now() }}" id="updated_at" class="form-control" name="updated_at" required>
                                    </div>
                                    
                                    <small class="text-secondary"> Terakhir diupdate {{ $systemUpdate->updated_at->diffForHumans() }}</small>
                                </div>
                                
                                <div class="col-md-6">
                                    
                                </div>
                            
                                <div class="d-flex justify-content-start">
                                    <button type="submit" class="btn btn-sm btn-primary my-3"><i class="fa-solid fa-edit"></i> Update</button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection