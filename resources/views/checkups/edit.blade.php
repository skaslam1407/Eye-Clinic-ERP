@extends('layouts.app')
@section('content')
<h4 class="mb-3">Edit Eye Checkup</h4>
<div class="card border-0 shadow-sm"><div class="card-body"><form method="POST" action="{{ route('checkups.update',$checkup) }}">@csrf @method('PUT') @include('checkups._form')<div class="mt-3"><button class="btn btn-dark">Update</button></div></form></div></div>
@endsection
