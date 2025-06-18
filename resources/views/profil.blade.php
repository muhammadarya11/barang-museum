@extends($layout)

@section('title', 'Profil Pengguna')

@section('konten')
<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        background-image: url('{{ asset('images/museumm.jpeg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed; 
    }

    .profile-section {
        min-height: calc(100vh - 150px); 
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .profile-card {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 16px;
        max-width: 600px;
        width: 100%;
        padding: 30px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="profile-section">
    <div class="profile-card">
        <h5 class="card-title mb-4">👤 <strong>Data Profil</strong></h5>
        <div class="mb-3">
            <p><strong>Nama Lengkap</strong>: {{ $user->nama ?? 'Tidak Ada Nama' }}</p>
            <p><strong>Email</strong>: {{ $user->email ?? 'Belum diisi' }}</p>
            <p><strong>Role</strong>: {{ $user->role ?? 'Tidak Ditentukan' }}</p>
        </div>
    </div>
</div>
@endsection