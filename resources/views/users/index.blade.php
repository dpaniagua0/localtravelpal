@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users
                    </div>

                    <div class="panel-body">
                        <a href="{{ route('users.create') }}" class="btn btn-primary" role="button">
                            Create user
                        </a>
                        <table class="table table-striped">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th class="text-center" style="width: 10%"><i class="fa fa-cog" aria-hidden="true"></i></th>
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
                                                <a class="btn btn-danger confirm-btn"  href="{!! route('users.delete', [$user->id]) !!}"
                                                   data-title="Are you sure?" data-message="Deleting this program,this will delete everything related to it">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



