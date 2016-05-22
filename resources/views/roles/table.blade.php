<table class="table table-striped">
    <thead>
    <th>Name</th>
    <th>Display name</th>
    <th>Description</th>
    <th>Created at</th>
    <th>Updated at</th>
    <th class="text-center" style="width: 20%"><i class="fa fa-cog" aria-hidden="true"></i></th>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->display_name }}</td>
            <td>{{ $role->description }}</td>
            <td>{{ $role->created_at }}</td>
            <td>{{ $role->updated_at }}</td>
            <td class="text-center" style="width:20%">
                <ul class="list-inline">
                    <li>
                        <a class="btn btn-success" href="{{ route('roles.show', $role->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-info"  href="{!! route('roles.edit', [$role->id]) !!}">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-danger confirm-btn"  href="{!! route('roles.delete', [$role->id]) !!}"
                           data-title="Are you sure?" data-message="Deleting this role,this will delete everything related to it">
                            <i class="fa fa-trash"></i>
                        </a>
                    </li>
                </ul>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $roles->links() !!}

