@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1">Branding</h4>
        <small class="text-muted">Upload logo, set theme color, and choose typography.</small>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label class="form-label">Logo</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
                @if($branding?->logo_path)
                    <div class="mt-2 d-flex align-items-center gap-2">
                        <img src="{{ asset('storage/'.$branding->logo_path) }}" alt="Clinic logo" style="height:60px;width:auto;border-radius:10px;object-fit:contain;">
                        <small class="text-muted">Current logo</small>
                    </div>
                @endif
            </div>
            <div class="col-md-3">
                <label class="form-label">Theme Color</label>
                <input type="color" name="brand_color" value="{{ old('brand_color', $branding->brand_color ?? '#0ea5e9') }}" class="form-control form-control-color" title="Choose theme color">
            </div>
            <div class="col-md-3">
                <label class="form-label">Font</label>
                <select name="font_family" class="form-select">
                    @foreach(['Manrope','Inter','Poppins','Nunito','Work Sans'] as $font)
                        <option value="{{ $font }}" @selected(old('font_family', $branding->font_family ?? 'Manrope') === $font)>{{ $font }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-dark">Save Branding</button>
            </div>
        </form>
    </div>
</div>
@endsection
