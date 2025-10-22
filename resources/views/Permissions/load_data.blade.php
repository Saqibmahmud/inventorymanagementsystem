@foreach ($permissions as $permission)
<tr>
    <td>{{ $permission->name }}</td>
    <td>
        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deletePermission(this, {{ $permission->id }})"><i class="fas fa-trash-alt"></i></a>
    </td>
</tr>
@endforeach
