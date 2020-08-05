@extends('layouts.app')

@section('content')
<div class="col">
    <div class="card">
        <div class="card-header">Employees</div>
        <div class="card-body">
            @if (count($employees))
            <div class="responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Employee E-mail</th>
                            <th>Employee Address</th>
                            <th>Employee Contact</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $item)
                        <tr>
                            <td>{{ $item->id}}</td>
                            <td>{{ $item->empName}}</td>
                            <td>{{ $item->empEmail}}</td>
                            <td>{{ $item->empAddress}}</td>
                            <td>{{ $item->empContact}}</td>
                            <td>
                                @if ($item->empStatus == 1)
                                Active
                                @elseif($item->empStatus == 0)
                                Inactive
                                @else
                                <b class="text-danger">Something's wrong</b>
                                @endif
                            </td>
                            <td>
                                <form action="/delEmp/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="form-group">
                                        <a href="/employee/{{$item->id}}" class="btn btn-success">Edit</a>
                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-dark">Delete</button>

                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $employees->links() }}
            </div>
            @else
            <strong>No data found</strong> <a class="btn btn-primary btn-sm" href="{{route('addEmp')}}">Add new
                employee</a>
            @endif
        </div>
    </div>
</div>
@endsection