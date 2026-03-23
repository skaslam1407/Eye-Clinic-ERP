@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1">Permissions</h4>
        <small class="text-muted">Toggle menu and feature access by role.</small>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('permissions.update') }}">
            @csrf
            <ul class="nav nav-pills mb-3" id="roleTabs" role="tablist">
                @foreach($roles as $index => $role)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($index===0) active @endif" id="role-tab-{{ $role->id }}" data-bs-toggle="tab" data-bs-target="#role-{{ $role->id }}" type="button" role="tab" aria-controls="role-{{ $role->id }}" aria-selected="{{ $index===0 ? 'true' : 'false' }}">
                            {{ $role->name }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($roles as $index => $role)
                    @php $current = $role->permissions ?? []; @endphp
                    <div class="tab-pane fade @if($index===0) show active @endif" id="role-{{ $role->id }}" role="tabpanel" aria-labelledby="role-tab-{{ $role->id }}">
                        @if($role->name === 'Super Admin')
                            <div class="alert alert-info mb-0">Super Admin always has full access.</div>
                        @else
                            <div class="row g-3">
                                @foreach($features as $key => $label)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[{{ $role->id }}][]" id="{{ $role->id }}-{{ $key }}" value="{{ $key }}" @checked(in_array($key, $current, true))>
                                            <label class="form-check-label" for="{{ $role->id }}-{{ $key }}">{{ $label }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-dark">Save Permissions</button>
            </div>
        </form>
    </div>
</div>
@endsection
