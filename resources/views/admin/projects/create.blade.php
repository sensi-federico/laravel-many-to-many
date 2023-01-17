@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    <h1 class="mt-4">Create a new Project!</h1>
    <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Add title"
                aria-describedby="titleHelper">
        </div>
        <div class="form-group d-flex flex-column py-3">
            <label for="cover">Cover Image</label>
            <input type="file" class="form-control-file" name="cover" id="cover" placeholder="Add a cover image"
                aria-describedby="coverImgHelper">
            <small id="coverImgHelper" class="form-text text-muted">Add a cover image</small>
        </div>
        <div class="my-3">
            <label for="description" class="form-label">Overview</label>
            <textarea class="form-control" name="overview" id="overview" rows="3" placeholder="Add Overview"></textarea>
        </div>



        <div class="mb-3">
            <label for="type_id" class="form-label">types</label>
            <select class="form-select form-select-lg @error('type_id') 'is-invalid' @enderror" name="type_id"
                id="type_id">
                <option selected>Select one</option>

                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach

            </select>
        </div>
        @error('type_id')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>
@endsection
