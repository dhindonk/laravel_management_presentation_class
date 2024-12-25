@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-start mb-4">
        <a href="{{ route('mahasiswa.index') }}" class="back-button text-white">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: var(--bs-primary); color: white;">
                    <h4 class="mb-0 text-white">Edit Pengajuan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.update', $kelompok->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="judul_proyek" class="form-label">Judul Proyek</label>
                            <input type="text" class="form-control" id="judul_proyek" name="judul_proyek" 
                                value="{{ $kelompok->judul_proyek }}" required>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="ketua" class="form-label">Ketua Kelompok</label>
                                <input type="text" class="form-control" id="ketua" name="ketua" 
                                    value="{{ $kelompok->ketua }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="npm_ketua" class="form-label">NPM Ketua</label>
                                <div class="input-group">
                                    <span class="input-group-text">0</span>
                                    <input type="number" class="form-control" id="npm_ketua" name="npm_ketua" 
                                        value="{{ $kelompok->npm_ketua }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Anggota Kelompok</label>
                            <div id="anggotaContainer">
                                @if(!empty($kelompok->anggota) && !empty($kelompok->npm_anggota))
                                    @php
                                        $anggotaList = json_decode($kelompok->anggota);
                                        $npmList = json_decode($kelompok->npm_anggota);
                                    @endphp
                                    @foreach($anggotaList as $index => $anggota)
                                        <div class="d-flex mb-2">
                                            <input type="text" class="form-control me-2" name="anggota[]" 
                                                value="{{ $anggota }}" placeholder="Anggota {{ $index + 1 }}">
                                            <div class="input-group">
                                                <span class="input-group-text">0</span>
                                                <input type="number" class="form-control" name="npm_anggota[]" 
                                                    value="{{ $npmList[$index] }}" placeholder="651***">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary mt-2" onclick="addAnggota()">
                                Tambah Anggota
                            </button>
                        </div>

                        <div class="mb-3">
                            <label for="kelas_id" class="form-label">Pilih Kelas</label>
                            <select id="kelas_id" name="kelas_id" class="form-select" required>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ $kelompok->kelas_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            Perhatian: Mengupdate pengajuan akan mereset status persetujuan dan jadwal yang sudah ada.
                            Anda perlu menunggu persetujuan admin kembali.
                        </div>

                        <div class="d-grid">
                            <button type="submit" id="submitBtn" class="btn w-100 position-relative overflow-hidden submit-btn">
                                <span class="submit-text">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addAnggota() {
    const anggotaContainer = document.getElementById('anggotaContainer');
    const anggotaCount = anggotaContainer.children.length;
    
    if (anggotaCount >= 4) {
        Swal.fire({
            icon: 'warning',
            title: 'Maksimal 4 Anggota',
            text: 'Tidak bisa menambah anggota lagi.',
        });
        return;
    }

    const div = document.createElement('div');
    div.classList.add('d-flex', 'mb-2');
    div.innerHTML = `
        <input type="text" class="form-control me-2" name="anggota[]" placeholder="Anggota ${anggotaCount + 1}">
        <div class="input-group">
            <span class="input-group-text">0</span>
            <input type="number" class="form-control" name="npm_anggota[]" placeholder="651***">
        </div>
    `;
    anggotaContainer.appendChild(div);
}
</script>

<style>
    .submit-btn {
        background: #09191F;
        border: none;
        color: white;
        padding: 12px 24px;
        transition: all 0.3s ease;
    }

    .submit-btn:hover:not(:disabled) {
        background: #efefef;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(9, 25, 31, 0.3);
    }

    .submit-btn:disabled {
        background: #94a3b8;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .submit-btn:active:not(:disabled) {
        transform: translateY(0);
        background: #061216;
    }

    .submit-text {
        position: relative;
        z-index: 1;
    }
</style>
@endsection 