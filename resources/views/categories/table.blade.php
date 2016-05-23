<table class="table table-striped">
    <thead>
    <th>Name</th>
    <th>Description</th>
    <th>Created at</th>
    <th>Updated at</th>
    <th class="text-center" style="width: 20%"><i class="fa fa-cog" aria-hidden="true"></i></th>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>
                @if(!empty($category->description))
                {{ 
                    $category->description 
                }}
                @else 
                    <label class="label label-info">no description</label>
                @endif
            </td>
            <td>{{ $category->created_at }}</td>
            <td>{{ $category->updated_at }}</td>
            <td class="text-center" style="width:20%">
                <ul class="list-inline">
                    <li>
                        <a class="btn btn-success" href="{{ route('categories.show', $category->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-info"  href="{!! route('categories.edit', [$category->id]) !!}">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-danger confirm-btn"  href="{!! route('categories.delete', [$category->id]) !!}"
                           data-title="Are you sure?" data-message="Deleting this category,this will delete everything related to it">
                            <i class="fa fa-trash"></i>
                        </a>
                    </li>
                </ul>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $categories->links() !!}

