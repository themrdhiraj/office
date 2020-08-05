@extends('layouts.app')

@section('content')
<div class="col">
    <div class="card">
        <div class="card-header">{{ __('Admin Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection