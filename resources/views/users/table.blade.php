<table class="table table-striped">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th class="text-center" style="width: 20%"><i class="fa fa-cog" aria-hidden="true"></i></th>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
            <td class="text-center" style="width:15%">
                <ul class="list-inline">
                    <li>
                        <a class="btn btn-success" href="{{ route('users.show', $user->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-info"  href="{!! route('users.edit', [$user->id]) !!}">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-danger confirm-btn"  href="{!! route('users.delete', [$user->id]) !!}"
                         data-title="Are you sure?" data-message="Deleting this user,this will delete everything related to it">
                         <i class="fa fa-trash"></i>
                     </a>
                 </li>
             </ul>

         </td>
     </tr>
     @endforeach
    </tbody>
</table>
{!! $users->links() !!}