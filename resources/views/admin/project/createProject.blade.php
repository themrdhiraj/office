@extends('layouts.app')

@section('content')
<div class="col">
    <div class="card">
        <div class="card-header">{{$act}} Project</div>
        <div class="card-body">
            <form action="{{route('storeProject')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="projName">Project Name</label>
                    <input type="text" id="projName" name="projName" class="form-control"
                        value="{{ isset($project) ? $project->projName : null }}"
                        placeholder="{{ isset($project) ? $project->projName : 'Project Name' }}">
                </div>

                <div class="form-group">
                    <label for="projDescr">Project Description</label>
                    <textarea name="projDescr" id="projDescr" class="form-control"
                        placeholder="{{ isset($project) ? $project->projDescr : 'Project Description' }}">{{ isset($project) ? $project->projDescr : null }}</textarea>
                </div>

                <div class="form-group">
                    <label for="projHand">Project Handeler</label>
                    <select name="projHand" id="projHand" class="form-control">
                        <option selected disabled>---Select Project Handeler---</option>
                        @foreach ($employees as $item)
                        <option value="{{$item->id}}" @if (isset($project) ? $project->projHand == $item->id : '')
                            selected
                            @endif>{{$item->empName}}</option>
                        @endforeach
                    </select>
                </div>
                @if (isset($project))
                <div class="form-group">
                    <label for="projStatus">Status</label>
                    <select name="projStatus" id="projStatus" class="form-control">
                        <option selected disabled>---Select Project Status---</option>
                        <option value="1" @if ($project->projStatus == 1)
                            selected
                            @endif>Accept</option>
                        <option value="0" @if ($project->projStatus == 0)
                            selected
                            @endif>Decline</option>
                        <option value="5" @if ($project->projStatus == 5)
                            selected
                            @endif>Wait</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$project->id}}">
                @endif
                <input type="hidden" name="act" value="{{$act}}">

                <button class="btn btn-primary" type="submit">{{$act}} Project</button>
            </form>
        </div>
    </div>
</div>
@endsection