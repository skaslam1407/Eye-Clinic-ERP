@extends('layouts.app')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
<h4>{{ $user->name }}</h4>
<p>Email: {{ $user->email }}</p>
<p>Phone: {{ $user->phone }}</p>
<p>Role: {{ optional($user->role)->name }}</p>
</div></div>
@endsection
