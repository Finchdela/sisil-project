@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Login</h4>
            </div>
            <div class="card-body">
                
                <!-- DEBUG INFO (Hapus setelah fix) -->
                <div class="alert alert-info">
                    <h6>Debug Info:</h6>
                    <p>Email admin: <strong>admin@silab.com</strong></p>
                    <p>Password: <strong>password</strong></p>
                    <p>Atau coba login dengan:</p>
                    <ul class="mb-0">
                        <li>isnan@silab.com / password (Dosen)</li>
                        <li>rehan@silab.com / password (Asisten)</li>
                        <li>mahasiswa@silab.com / password (Mahasiswa)</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('register') }}">Belum punya akun? Daftar disini</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection