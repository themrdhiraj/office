<div class="col">
    <div class="card">
        <div class="card-header">@php
            echo isset($act) ? $act : '';
            @endphp {{ __('Departments') }}</div>
        <div class="card-body">
            <form action="@if($act == 'Update')
                    /depUpdate/{{$department->id}}
                    @elseif($act == 'Add')
                    {{route('department')}}
                    @else
                    Error
                    @endif" method="POST">
                @csrf
                <div class="form-group">
                    <label for="depName">Department Name</label>
                    <input id="depName" value="@if($act == 'Update') {{$department->depName}} @endif" name="depName"
                        type="text" class="form-control">
                    @if($act == 'Update')
                    <label for="depStatus">Department Status</label>
                    <select name="depStatus" id="depStatus" class="form-control">
                        <option value="1" @if ($department->depStatus == 1)
                            selected
                            @endif>Active</option>
                        <option value="0" @if ($department->depStatus == 0)
                            selected
                            @endif>Inactive</option>
                    </select>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">
                    @if($act == 'Update')
                    @method('PUT')
                    Update
                    @elseif($act == 'Add')
                    Add New
                    @else
                    Error
                    @endif
                </button>
                @if($act == 'Update')
                <a href="/adminSettings" class="btn btn-secondary">Cancel</a>
                @endif
            </form>
            @if ($act == 'Add' && count($departments))
            <hr>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->depName }}</td>
                        <td>
                            @if ($department->depStatus == 1)
                            Active
                            @elseif($department->depStatus == 0)
                            Inactive
                            @else
                            <span class="text-danger">Something's Wrong</span>
                            @endif
                        </td>
                        <td>
                            <form action="/department/{{ $department->id }}/delete" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group">
                                    <a href="/adminSettings/{{ $department->id }}" class="btn btn-success">Edit</a>
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="btn btn-dark">Delete</button>

                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $departments->links() }}
            @elseif($act == 'Add')
            <strong>No data found</strong>
            @endif
        </div>
    </div>
</div>