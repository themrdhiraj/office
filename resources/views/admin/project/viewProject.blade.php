@extends('layouts.app')

@section('content')
<div class="col">
    <div class="card">
        <div class="card-header">Projects</div>
        <div class="card-body">
            @if (count($projects))
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Project Description</th>
                            <th>Project Handler</th>
                            <th>Project Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->projName}}</td>
                            <td>{{$item->projDescr}}</td>
                            <td>{{$item->empName}}</td>
                            <td>
                                @if ($item->projStatus == 1)
                                Accepted
                                @elseif($item->projStatus == 5)
                                Pending
                                @elseif($item->projStatus == 0)
                                Declined
                                @else
                                Unknown
                                @endif
                            </td>
                            <td>
                                <form action="/delProj/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group">
                                        <a href="/project/{{$item->id}}" class="btn btn-success">Edit</a>
                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-dark">Delete</button>

                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $projects->links() }}
            </div>
            @else
            <strong>No data found</strong>
            @endif
        </div>
    </div>
</div>
@endsection