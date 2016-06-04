<table class="table table-striped">
    <thead>
        <th>Title</th>
        <th>Location</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th class="text-center" style="width: 20%"><i class="fa fa-cog" aria-hidden="true"></i></th>
    </thead>
    <tbody>
        @foreach($experiences as $experience)
        <tr>
            <td>{{ $experience->title }}</td>
            <td>{{ $experience->location }}</td>
            <td>{{ $experience->created_at }}</td>
            <td>{{ $experience->updated_at }}</td>
            <td class="text-center" style="width:15%">
                <ul class="list-inline">
                    <li>
                        <a class="btn btn-success" href="{{ route('experiences.show', $experience->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-info"  href="{!! route('experiences.edit', [$experience->id]) !!}">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-danger confirm-btn"  href="{!! route('experiences.delete', [$experience->id]) !!}"
                         data-title="Are you sure?" data-message="Deleting this experience,this will delete everything related to it">
                         <i class="fa fa-trash"></i>
                     </a>
                 </li>
             </ul>

         </td>
     </tr>
     @endforeach
    </tbody>
</table>
{!! $experiences->links() !!}