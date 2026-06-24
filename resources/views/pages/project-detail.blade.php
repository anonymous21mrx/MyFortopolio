@extends('layouts.app')

@section('title', 'Projects Detail')
@section('content')
    <style>
        .card-img-top {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            object-position: center;
        }
    </style>
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-8 max-auto">
                <div class="card shadow-sm">
                    <img class="card-img-top" src="{{ asset('images/' . $project->image) }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <div class="mb-4">
                            <h5>Deskripsi Project</h5>
                            <p class="card-text">{{ $project->description }}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Teknologi yang Digunakan</h5>
                                <p class="card-text">{{ $project->teknologi }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Status Project</h5>
                                <p class="card-text">{{ $project->status }}</p>
                            </div>
                        </div>
                        <a href="{{ route('projects') }}" class="btn btn-primary w-100">Kembali ke Daftar Proyek</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection