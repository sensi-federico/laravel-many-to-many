@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    <h1 class="mt-4">Edit Project!</h1>
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
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

        <div class="mb-3">
            <label for="technologies" class="form-label">technologies</label>
            <select multiple class="form-select form-select-sm" name="technologies[]" id="technologies">
                <option value="" disabled>Select a technology</option>
                @forelse ($technologies as $technology)
                    @if ($errors->any())
                        <!-- Pagina con errori di validazione, deve usare old per verificare quale id di technology preselezionare -->
                        <option value="{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                            {{ $technology->name }}</option>
                    @else
                        <!-- Pagina caricate per la prima volta: deve mostrarare i technology preseleziononati dal db -->
                        <option value="{{ $technology->id }}"
                            {{ $project->technologies->contains($technology->id) ? 'selected' : '' }}>
                            {{ $technology->name }}</option>
                    @endif
                @empty
                    <option value="" disabled>Sorry 😥 no technologies in the system</option>
                @endforelse

            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
@endsection
