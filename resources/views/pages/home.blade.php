@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 text-center">
            <h1 class="display-4">Halo, Saya Agun</h1>
           <img src="{{asset('img/gambar.png') }}" alt="Profile Image" class="rounded-circle mb-4" width="220" height="250">
            <p class="lead">Saya adalah seorang Mahasiswa Sistem Informasi, tapi saya ga bisa ngoding, gak bisa bikin website, gabisa ngedesaign, gabisa ngapa-ngapain, cara pakai discord aja gatau gimana caranya. Beginilah nasib saya.</p>
            <hr>
            <p>Selamat Datang dihalaman web profile saya</p>
        </div>
    </div>

    <div class="row mt-5 text-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pengalaman</h5>
                    <p class="card-text">2 semester pengalaman</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Project</h5>
                    <p class="card-text">20 Project Tidak Selesai</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Klien</h5>
                    <p class="card-text">50+ Klien Tidak Puas</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection