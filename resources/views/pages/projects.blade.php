@extends('layouts.app')

@section('title', 'Projects')
@section('content')
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
            object-position: center;
        }
    </style>
    <div class="container">
        <div class="row mt-5 text-center">
            @forelse($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="{{ asset('images/' . $project->image) }}"
                            alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <p class="text-muted">{{ $project->teknologi }}</p>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
            <div class="d-flex justify-content-center mt-4">
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection