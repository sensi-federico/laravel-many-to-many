@extends('layouts.admin')
@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}" role="button">Back to index</a>
        </div>
        <div class="card text-left">
            <div class="card-body">
                <div>
                    <h3>Id: {{ $project->id }}</h3>
                </div>
                <div>
                    <h1>Title: {{ $project->title }}</h1>
                </div>
                <div>
                    <h3>Description: {{ $project->overview }}</h3>
                </div>
                <div class="category">
                    <strong>type:</strong>
                    {{ $project->type_id ? $project->type->name : ' No type match' }}
                </div>
            </div>
        </div>



    </div>
@endsection
