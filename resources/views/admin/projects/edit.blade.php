@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    <h1 class="mt-4">Edit Project!</h1>
    <form action="{{ route('admin.projects.update', $project->id) }}" method="project">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Add title"
                aria-describedby="titleHelper" value="{{ old('title', $project->title) }}">
        </div>
        <div class="my-3">
            <label for="description" class="form-label">Overview</label>
            <textarea class="form-control" name="overview" id="overview" rows="3">{{ old('overview', $project->overview) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="type_id" class="form-label">types</label>
            <select class="form-select form-select-lg @error('type_id') 'is-invalid' @enderror" name="type_id"
                id="type_id">
                <option value="">Uncategorize</option>

                @forelse ($types as $type)
                    <!-- Check if the project has a type assigned or not                                    👇 -->
                    <option value="{{ $type->id }}"
                        {{ $type->id == old('type_id', $project->type ? $project->type->id : '') ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @empty
                    <option value="">Sorry, no types in the system.</option>
                @endforelse

            </select>
        </div>
        @error('type_id')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
@endsection
