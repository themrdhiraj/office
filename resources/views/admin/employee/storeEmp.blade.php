@extends('layouts.app')

@section('content')
<div class="col">
    <div class="card">
        <div class="card-header">
            {{$act}} Employee
        </div>
        <div class="card-body">
            <form action="{{route('storeEmp')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="empName">Employee Name</label>
                    <input type="text" id="empName" name="empName" class="form-control"
                        placeholder="{{ isset($employee) ? $employee->empName : 'Employee Name' }}"
                        value="{{ isset($employee) ? $employee->empName : null }}">
                </div>

                <div class="form-group">
                    <label for="empEmail">Employee E-mail</label>
                    <input type="text" id="empEmail" name="empEmail" class="form-control"
                        placeholder="{{ isset($employee) ? $employee->empEmail : 'Employee E-mail' }}"
                        value="{{ isset($employee) ? $employee->empEmail : null }}">
                </div>

                <div class="form-group">
                    <label for="empAddress">Employee Address</label>
                    <input type="text" id="empAddress" name="empAddress" class="form-control"
                        placeholder="{{ isset($employee) ? $employee->empAddress : 'Employee Address' }}"
                        value="{{ isset($employee) ? $employee->empAddress : null }}">
                </div>

                <div class="form-group">
                    <label for="empContact">Employee Contact no.</label>
                    <input type="tel" id="empContact" name="empContact" class="form-control"
                        placeholder="{{ isset($employee) ? $employee->empContact : 'Employee Contact' }}"
                        value="{{ isset($employee) ? $employee->empContact : null }}">
                </div>

                @if($act == 'Update')
                <div class="form-group">
                    <label for="empStatus">Employee Status</label>
                    <select name="empStatus" id="empStatus" class="form-control">
                        <option value="1" @if ($employee->empStatus == 1)
                            selected
                            @endif>Active</option>
                        <option value="0" @if ($employee->empStatus == 0)
                            selected
                            @endif>Inactive</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$employee->id}}">
                @endif
                <input type="hidden" name="act" value="{{$act}}">

                <button class="btn btn-primary" type="submit">{{$act}} Employee</button>
                @if ($act == 'Update')
                <a href="/viewEmp" class="btn btn-secondary">Cancel</a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection