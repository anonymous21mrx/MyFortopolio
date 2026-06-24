@extends('admin.template')
@section('content')
<div class=" mt-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3>Edit Project</h3>
           <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Project</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}"required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="teknologi" class="form-label">Teknologi</label>
                        <input type="text" class="form-control" id="teknologi" name="teknologi" value="{{ $project->teknologi }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-control" required>
        <option value="">Pilih Status</option>
        <option value="active" {{ $project->status === 'active' ? 'selected' : '' }}>Active</option>
        <option value="archived" {{ $project->status === 'archived' ? 'selected' : '' }}>Archived</option>
    </select>
</div>
                    <div class="col-md-6 mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image">
</div>

<div class="col-md-12 mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $project->description }}</textarea>
</div>

<div class="col-md-12 mb-3">
    <button type="submit" class="btn btn-primary">Ubah</button>
    <a href="{{ route('projects.index') }}" class="btn btn-danger">Batal</a>
</div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection