@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h4>Users & Roles</h4><a href="{{ route('users.create') }}" class="btn btn-dark">Add User</a></div>
<div class="card border-0 shadow-sm"><div class="card-body table-wrap">
<table class="table table-striped"><thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th class="text-end">Action</th></tr></thead>
<tbody>@forelse($users as $user)<tr><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->phone }}</td><td>{{ optional($user->role)->name }}</td><td class="text-end"><a href="{{ route('users.edit',$user) }}" class="btn btn-sm btn-outline-primary">Edit</a> <form method="POST" action="{{ route('users.destroy',$user) }}" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete user?')">Delete</button></form></td></tr>@empty<tr><td colspan="5">No users found.</td></tr>@endforelse</tbody>
</table>
{{ $users->links() }}
</div></div>
@endsection
