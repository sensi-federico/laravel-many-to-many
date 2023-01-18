@extends('layouts.admin')
@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}" role="button">Back to index</a>
        </div>
        <div class="card text-left">
            <div class="card-body">
                {{-- id --}}
                <div>
                    <h3>Id: {{ $project->id }}</h3>
                </div>
                {{-- title --}}
                <div>
                    <h1>Title: {{ $project->title }}</h1>
                </div>
                {{-- description --}}
                <div>
                    <h3>Description: {{ $project->overview }}</h3>
                </div>
                {{-- category --}}
                <div class="category">
                    <strong>type:</strong>
                    {{ $project->type_id ? $project->type->name : ' No type match' }}
                </div>
                {{-- technologies --}}
                <div class="technologies">
                    <strong>technologies:</strong>
                    @if (count($project->technologies) > 0)
                        @foreach ($project->technologies as $technology)
                            <span>#{{ $technology->name }} </span> <!-- #css #php #js -->
                        @endforeach
                    @else
                        <span>Not technology associated to the current project</span>
                    @endif

                </div>
            </div>
        </div>



    </div>
@endsection
