<table class="table table-striped">
    <thead>
        <th>Title</th>
        <th>Location</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th class="text-center" style="width: 20%"><i class="fa fa-cog" aria-hidden="true"></i></th>
    </thead>
    <tbody>
        @foreach($destinations as $destination)
        <tr>
            <td>{{ $destination->title }}</td>
            <td>{{ $destination->location }}</td>
            <td>{{ $destination->created_at }}</td>
            <td>{{ $destination->updated_at }}</td>
            <td class="text-center" style="width:15%">
                <ul class="list-inline">
                    <li>
                        <a class="btn btn-success" href="{{ route('destinations.show', $destination->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-info"  href="{!! route('destinations.edit', [$destination->id]) !!}">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-danger confirm-btn"  href="{!! route('destinations.delete', [$destination->id]) !!}"
                         data-title="Are you sure?" data-message="Deleting this destination,this will delete everything related to it">
                         <i class="fa fa-trash"></i>
                     </a>
                 </li>
             </ul>

         </td>
     </tr>
     @endforeach
    </tbody>
</table>
{!! $destinations->links() !!}