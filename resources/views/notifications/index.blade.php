@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h4>Notification Logs</h4><a href="{{ route('notifications.create') }}" class="btn btn-dark">Send Notification</a></div>
<div class="card border-0 shadow-sm"><div class="card-body table-wrap">
<table class="table table-striped"><thead><tr><th>Patient</th><th>Type</th><th>Channel</th><th>Recipient</th><th>Sent At</th><th>Status</th><th class="text-end">Actions</th></tr></thead><tbody>
@forelse($logs as $log)
<tr>
    <td>{{ optional($log->patient)->name }}</td>
    <td>{{ $log->type }}</td>
    <td>{{ $log->channel }}</td>
    <td>{{ $log->recipient }}</td>
    <td>{{ $log->sent_at?->format('Y-m-d H:i') }}</td>
    <td>{{ $log->status ?? '—' }}</td>
    <td class="text-end">
        <form method="POST" action="{{ route('notifications.destroy', $log) }}" onsubmit="return confirm('Delete this log?');" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">Delete</button>
        </form>
    </td>
</tr>
@empty
<tr><td colspan="7">No logs found.</td></tr>
@endforelse
</tbody></table>
{{ $logs->links() }}
</div></div>
@endsection
